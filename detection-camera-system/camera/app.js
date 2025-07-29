const express = require("express")
const app = express()
const morgan = require('morgan')
const http = require("http")
const server = http.createServer(app)
const { Server } = require("socket.io")
const io = new Server(server)
const cors = require("cors")
const { join } = require('node:path')
const fs = require('fs')
const zlib = require("zlib")

const sql = require('mssql');


// const io = new Server(server, {
//     cors: { origin: "*" }, // อนุญาตให้ทุกโดเมนเชื่อมต่อ WebSocket
// });
// app.use(express.json())
app.use(cors())
app.use(morgan('dev'))

// app.post('/api', (req,res)=>{
//     const { username, password } = req.body
//     // console.log(username, password)
//     console.log(req.body)
//     res.send(username)
// })

const config = {
    user: 'nwlproduction',
    password: 'Nwl!2563789!',
    server: '85.204.247.82',
    port: 26433,
    options: {
        encrypt: true, // สำหรับ Azure SQL
        trustServerCertificate: true // หากใช้ self-signed cert
      }

  };



app.get('/api/data', async (req, res) => {
    try {

        await sql.connect(config);
        
        const result = await sql.query`SELECT 1 AS status`;
        
        await sql.close();
        
        res.json({ 
          success: true,
          message: "Connection successful",
          databaseStatus: result.recordset[0].status // ได้ค่า 1 แสดงว่าฐานข้อมูลตอบสนองปกติ
        });
        
      } catch (err) {
     
        res.status(500).json({ 
          success: false,
          error: err.message,
          details: "Failed to connect to SQL Server"
        });
      }
  });

// const bodyParser = require('body-parser');
// ใช้ body-parser เพื่อรับข้อมูล JSON จาก POST
// app.use(bodyParser.json());
// app.use(bodyParser.urlencoded({ extended: true }));

app.get("/dahua-event/", async (req, res) => {
    try {
        timeCount()
        console.log('Event received successfully on backend')
        // res.sendFile(__dirname + '/index.html');
        // res.sendFile(join(__dirname, 'index.html'));
        res.json({ msg: 'Event received successfully json' });
    } catch (error) {
        console.log(error);
        res.status(500).json({ message: 'Server Error' });
    }
});

app.get('/check-url', async ()=> {

    

    
    //check the received urls if it's accessible or not
    async function checkStream(url) {
        try {
          const response = await fetch(url, { method: 'HEAD' });
      
          if (response.ok) {
            console.log('✅ Stream is available:', url);
            return true;
          } else {
            console.warn('⚠️ Stream not available (status):', response.status);
            return false;
          }
        } catch (error) {
          console.error('❌ Error checking stream:', error);
          return false;
        }
      }
      
      
      checkStream('http://www.centrecities.com:8090/detectionstreamingvdo2/10');
      
})

// SQL Server Configuration
const { exec } = require('child_process');
function getFormattedFolderName(cameraId) {
    const now = new Date();
    const datePart = now.toISOString().slice(0, 10).replace(/-/g, ""); // YYYYMMDD
    const timePart = now.toTimeString().slice(0, 8).replace(/:/g, ""); // HHMMSS
    return `${cameraId}_${datePart}_${timePart}`;
}

// WebSocket Connection
let countdownActive = false; // Flag to track countdown status
io.on('connection', (socket) => {
    console.log('Client connected');
    if (countdownActive) {
        socket.emit('countdownUpdate', { time: 'Countdown is active. Please wait.' });
        socket.disconnect();
        return;
    }
    let countdown = 10;
    countdownActive = true; // Set countdown status to active
    const countdownInterval = setInterval(async () => {
        if (countdown <= 0) {
            clearInterval(countdownInterval); // Stop the countdown when it reaches 0
            socket.emit('countdownUpdate', { time: '00:00' }); // Emit the final time
            countdownActive = false; // Reset countdown status when it finishes
            // killProcessAfterTimeout();
            console.log('end');
        } else {
            const currentTime = getFormattedTime(countdown);
            socket.emit('countdownUpdate', { time: currentTime }); // Emit current countdown time
            if (currentTime == '01:00') {

                const responsex = await fetch('http://localhost/camera/lineNotify.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                });

                const resultx = await responsex.text(); // Get response from PHP
                console.log("Response from PHP:", resultx);
            }
            try {
                console.log(`Time inserted with ID: ${currentTime}`);
            } catch (error) {
                console.error('SQL Insert Error:', error);
            }
            countdown--;  // Decrease countdown by 1 second
        }
    }, 1000); // Send updates every second

    socket.on('clientEvent', async (data) => {
        console.log('Received from client:', data);
        try {
            const insertedId = await insertData(data);
            socket.emit('serverResponse', { status: 'success', insertedId });
        } catch (error) {
            console.error('SQL Insert Error:', error);
            socket.emit('serverResponse', { status: 'error', message: error.message });
        }
    });

    socket.on('disconnect', () => {
        console.log('Client disconnected');
    });
});

function getFormattedTime(seconds) {
    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = seconds % 60;
    return `${String(minutes).padStart(2, '0')}:${String(remainingSeconds).padStart(2, '0')}`;
}
const now = new Date();
const formattedDate = now.toISOString().slice(0, 10).replace(/-/g, '');
const formattedTime = now.toTimeString().slice(0, 8).replace(/:/g, '');
const FN = `CAM202412001_${formattedDate}_${formattedTime}`;
console.log(FN);

async function insertData(FN) {
    try {
        const response = await fetch('http://localhost/camera/insert.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ param: FN })
        });

        const result = await response.text(); // รับค่าตอบกลับจาก PHP
        console.log("Response from PHP:", result);
    } catch (error) {
        console.error("Error:", error);
    }
}



// // ฟังก์ชันที่ใช้หยุดโปรเซสหลังจาก 60 วินาที
// function killProcessAfterTimeout() {
//     const timeout = 60000; // 60 วินาที (60000 มิลลิวินาที)

//     setTimeout(() => {
//         // คำสั่งที่ใช้หาค่า PID ของโปรเซสที่ใช้พอร์ต 3000
//         exec('netstat -ano | findstr :3000', (err, stdout, stderr) => {
//             if (err || stderr) {
//                 console.error('Error finding PID:', err || stderr);
//                 return;
//             }

//             // แยก PID ออกจากผลลัพธ์
//             const pidMatch = stdout.match(/\s(\d+)\r\n/);
//             if (pidMatch && pidMatch[1]) {
//                 const pid = pidMatch[1];
//                 console.log(`Found PID: ${pid}. Now killing the process.`);

//                 // ใช้คำสั่ง taskkill ปิดโปรเซสที่ใช้งาน PID นั้น
//                 exec(`taskkill /F /PID ${pid}`, (err, stdout, stderr) => {
//                     if (err || stderr) {
//                         console.error('Error killing process:', err || stderr);
//                     } else {
//                         console.log(`Process with PID ${pid} has been terminated.`);
//                     }
//                 });
//             } else {
//                 console.log('No process found using port 3000.');
//             }
//         });
//     }, timeout); // รอ 60 วินาที
// }


const timeCount = async () => {
    try {
        let countdown = 1;
        countdownActive = true; // Set countdown status to active
        const countdownInterval = setInterval(async () => {
            // socket.emit('countdownUpdate', { time: currentTime }); // Emit current countdown time
            if (countdown <= 0) {
                clearInterval(countdownInterval); // Stop the countdown when it reaches 0
                countdownActive = false;
                insertData(FN)
               .then((res)=>{ 
                console.log('end...')
               })
               .catch((err)=>{console.log(err)})

            } else {
                const currentTime = getFormattedTime(countdown);
        
                if (currentTime == '01:00') {
                    const responsex = await fetch('http://localhost/camera/lineNotify.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ param: FN }) // Send FN as JSON body
                    });
                    const resultx = await responsex.text(); // Get response from PHP
                    console.log("Response from PHP:", responsex);
                }
                console.log(`Time inserted with ID: ${currentTime}`);
            }
            countdown--; // Decrease countdown by 1 second
        }, 1000); // Send updates every second
    } catch (error) {
        console.error('SQL Insert Error:', error);
    }
}

// Start Server
server.listen(3000, () => {
    console.log('Server listening on port 3000');
});
