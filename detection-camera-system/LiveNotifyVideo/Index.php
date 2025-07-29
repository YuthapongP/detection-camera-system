<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>NetWorklink.Co.Ltd,</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link rel="stylesheet" href="fonts/font-kanit.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/snappaging_.css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <!-- Date Pick jquery ui-->
</head>

<style>

    #streamContainer {
        gap: 8px;
    }

    .video-wrapper {
        width: 390px;
        height: 304px;
        overflow: hidden;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    #cameraDropdown {
        max-width: 400px;
        max-height: 200px;
        overflow-y: auto;
    }


    .camera-status {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        display: inline-block;
        margin-left: 8px;
    }

    .online {
        background-color: #28a745;
    }

    .offline {
        background-color: #dc3545;
    }

    .video-wrapper {
        margin: 10px;
        position: relative;
    }

    .dropdown-custom {
        border: 1px solid black;
        border-radius: 10px;
        padding: 10px;
        width: 300px;
        margin-top: 10px;
    }

    .camera-item {
        display: flex;
        align-items: center;

    }

    .camera-item input[type="checkbox"] {
        width: 18px;
        height: 18px;
        margin-right: 10px;
    }

    .camera-label {
        flex-grow: 1;
        font-weight: bold;
    }


    .camera-item input[type="checkbox"] {
        -webkit-appearance: checkbox !important;
        -moz-appearance: checkbox !important;
        appearance: checkbox !important;
        width: 18px !important;
        height: 18px !important;
        margin-right: 10px !important;
        opacity: 1 !important;
        display: inline-block !important;
        visibility: visible !important;
    }


    /* @media only screen and (max-width: 500px) {
        .bottom-bar {
            justify-content: space-between !important;
        }

        .snap-btn {
            justify-content: center !important;
        }

        .vdo-btn {
            justify-content: center !important;
        }

        .streamdiv {
            height: 560px !important;
        }
    }

    @media only screen and (max-width: 600px) {
        iframe {
            width: 350px;
            height: 282px;
        }
    }

    @media only screen and (min-width: 601px) {
        iframe {
            width: 800px;
            height: 650px;
        }
    } */
</style>

<body>
    <?php
    if (isset($_GET['param'])) {
        $getparam = $_GET['param'];
        $urlimg = "/SnapShot/snappaging_.php?param={$getparam}";
        $urlvdo = "/SnapShot/vdopaging_.php?param={$getparam}";
    } else {
        $urlimg = "/SnapShot/snappaging_.php";
        $urlvdo = "/SnapShot/vdopaging_.php";
        $getparam = '';
    }
    ?>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-lg-5">
            <img src="../snapshot/assets/nwl-logo.png" alt="NetWorklink" width="50">
            <span style="letter-spacing: 1px;" class="text-white" href="#!">NetWorklink.Co.Ltd,</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item bg-dark"><a class="nav-link active" aria-current="page"
                            href="/LiveNotifyVideo/">Streamimg</a></li>
                    <li class="nav-item bg-dark"><a class="nav-link" href="<?= $urlimg; ?>">Snapshot</a></li>
                    <li class="nav-item bg-dark"><a class="nav-link" href="<?= $urlvdo; ?>">Snap Videos</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="py-2 ">
        <div class="container px-lg-5 ">
            <div class="p-4 p-lg-5 bg-light rounded-3 text-center bg-dark">
                <div class="">
                    <h1 class="display-5 fw-bold text-white text-uppercase" style="letter-spacing: 10px">Streaming</h1>
                </div>
                <div class="col-md-12 d-flex justify-content-center align-items-center d-none">
                    <select class="form-select " aria-label="Default select example" id="selectoption"
                        style="width: 15%;">
                        <option selected>Open this select menu</option>
                    </select>
                </div>
            </div>
    </header>
    <!-- Page Content-->
    <section class="p-1 text-center" style="height_: 100vh;">
        <!-- Camera Selection -->
        <div class="container text-center mt-3 position-relative">
            <button class="btn btn-outline-dark mb-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#cameraDropdown" style="min-width: 300px; width: 300px; max-width: 100%;">
                Select Camera
            </button>

            <div id="cameraDropdown" class="collapse dropdown-menu p-3 mx-auto"
                style="width: 300px; left: 50%; transform: translateX(-50%);">

                <div class="camera-item form-check">
                    <input class="form-check-input" type="checkbox" id="camera-2" data-stream="stream2">
                    <label class="form-check-label camera-label" for="camera-2">Entrance Camera</label>
                    <span id="camera-2-status" class="camera-status online"></span>
                </div>
                <div class="camera-item form-check">
                    <input class="form-check-input" type="checkbox" id="camera-1" data-stream="stream1">
                    <label class="form-check-label camera-label" for="camera-1">Entrance Camera</label>
                    <span id="camera-1-status" class="camera-status online"></span>
                </div>


                <!-- Add more unique cameras as needed -->
            </div>
        </div>

        <!-- Stream Container -->
        <div
  id="streamContainer"
  class="mt-4 row g-3 container mx-auto overflow-auto"
  style="max-height: 500px;"
>
            <!-- Iframes will appear here dynamically -->
        </div>
    </section>

    <!-- Footer-->
    <script>
        let roundcheck = 0
        const getparams = '<?= $getparam; ?>'

        const Calldata = async () => {
            if (!getparams) {
                console.log('No Params')
                return false
            } else {
                const url = `http://85.204.247.82:26300/api/getlogs/${getparams}`
                await fetch(url)
                    .then(resp => {
                        if (!resp.ok) {
                            throw new Error('Network response was not ok')
                        }
                        return resp.json()
                    })
                    .then(resp => {
                        const picstatus = resp.picstatus
                        const vdostatus = resp.vdostatus
                        if (picstatus == 1) {
                            $('.btn-snap').removeClass("btn-secondary")
                            $('.btn-snap').addClass("btn-success")
                        } else {
                            FetchDatas()
                        }
                        if (vdostatus == 1) {
                            $('.btn-vdo').removeClass("btn-secondary")
                            $('.btn-vdo').addClass("btn-success")
                        } else {
                            FetchDatas()
                        }
                    })
            }
        }
        Calldata()

        const FetchDatas = async () => {
            if (!getparams) {
                console.log('No Params')
                return false
            } else {
                const url = `http://85.204.247.82:26300/api/getlogs/${getparams}`
                console.log('Round Check =', roundcheck)
                if (roundcheck == 5) {
                    return false
                }
                let time = 60
                console.log('timer: ', time)
                const setinterval = setInterval(async () => {
                    time = time - 10
                    console.log('timer: ', time)
                    if (time == 0) {
                        await fetch(url)
                            .then(resp => {
                                if (!resp.ok) {
                                    throw new Error('Network response was not ok')
                                }
                                return resp.json()
                            })
                            .then(resp => {
                                const picstatus = resp.picstatus
                                const vdostatus = resp.vdostatus
                                if (picstatus == 1) {
                                    clearInterval(setinterval)
                                    $('.btn-snap').removeClass("btn-secondary")
                                    $('.btn-snap').addClass("btn-success")
                                } else {
                                    FetchDatas()
                                }
                                if (vdostatus == 1) {
                                    clearInterval(setinterval)
                                    $('.btn-vdo').removeClass("btn-secondary")
                                    $('.btn-vdo').addClass("btn-success")
                                } else {
                                    FetchDatas()
                                }
                            })
                    }
                }, 10000)
                roundcheck++
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const dropdownButton = document.querySelector('[data-bs-target="#cameraDropdown"]');
            const dropdownMenu = document.getElementById('cameraDropdown');

            // Close dropdown when clicking outside
            document.addEventListener('click', function (event) {
                const isClickInside = dropdownMenu.contains(event.target) ||
                    dropdownButton.contains(event.target);

                if (!isClickInside && dropdownMenu.classList.contains('show')) {
                    // Use Bootstrap's collapse method to properly hide it
                    const collapseInstance = bootstrap.Collapse.getInstance(dropdownMenu);
                    if (collapseInstance) {
                        collapseInstance.hide();
                    }
                }
            });
        });

        const cameras = {
                1: {
                    url: 'http://www.centrecities.com:8090/detectionstreamingvdo2/',
                    name: 'Entrance Camera'
                },
                2: {
                    url: 'https://www.youtube.com/embed/YE7VzlLtp-4',
                    name: 'Parking Lot'
                },
                3: {
                    url: 'https://www.youtube.com/embed/YE7VzlLtp-4',
                    name: 'Kitchen'
                },
                4: {
                    url: 'https://www.youtube.com/embed/YE7VzlLtp-4',
                    name: 'Garden'
                },
                5: {
                    url: 'https://www.youtube.com/embed/YE7VzlLtp-4',
                    name: 'Garden'
                },
                6: {
                    url: 'https://www.youtube.com/embed/YE7VzlLtp-4',
                    name: 'Garden'
                },
                7: {
                    url: 'https://www.youtube.com/embed/YE7VzlLtp-4',
                    name: 'Garden'
                },
                8: {
                    url: 'https://www.youtube.com/embed/YE7VzlLtp-4',
                    name: 'Garden'
                },
            };


        document.addEventListener('DOMContentLoaded', async function () {
         
            // Checkbox and stream container setup
            const checkboxes = document.querySelectorAll('.form-check-input');

            const streamContainer = document.getElementById('streamContainer');

            // Stream URLs
            const streams = {
                stream1: 'http://www.centrecities.com:8090/detectionstreaming/detectionstreamingvdo1/',
                stream2: 'http://www.centrecities.com:8090/detectionstreaming/detectionstreamingvdo1/',
                stream3: 'http://www.centrecities.com:8090/detectionstreamingvdo2/',
                stream4: 'https://www.youtube.com/embed/YE7VzlLtp-4',
                stream5: 'https://www.youtube.com/embed/YE7VzlLtp-4',
                stream6: 'https://www.youtube.com/embed/YE7VzlLtp-4',
                stream7: 'https://www.youtube.com/embed/YE7VzlLtp-4',
                stream8: 'https://www.youtube.com/embed/YE7VzlLtp-4',
            };

            // Improved stream checking for YouTube
            async function isStreamReachable(url) {
                return new Promise((resolve) => {
                    const video = document.createElement('video');
                    video.muted = true;
                    video.playsInline = true;

                    video.onloadeddata = () => {
                        video.remove();
                        resolve(true);
                    };

                    video.onerror = () => {
                        video.remove();
                        resolve(false);
                    };

                    video.src = url;
                    video.load();
                });
            }

            // Update single camera status
            async function updateCameraStatus(cameraId, streamUrl) {
                try {
                    const isOnline = await isStreamReachable(streamUrl);

                    const statusElement = document.querySelector(`#camera-${cameraId}-status`);

                    if (statusElement) {
                        statusElement.classList.remove('online', 'offline');
                        statusElement.classList.add(isOnline ? 'online' : 'online');
                    }
                    return isOnline;
                } catch (error) {
                    console.error(`Error updating camera ${cameraId}:`, error);
                    return false;
                }
            }

            // Update all camera statuses
            async function updateAllCameraStatuses() {
                for (const [cameraId, cameraInfo] of Object.entries(cameras)) {
                    await updateCameraStatus(cameraId, cameraInfo.url);
                }
            }

            // Update streams based on checkbox selection
            async function updateStreams() {
                streamContainer.innerHTML = '';
                const selected = Array.from(checkboxes)
                    .filter(cb => cb.checked)
                    .map(cb => ({
                        id: cb.dataset.stream,
                        name: cb.nextElementSibling.textContent.trim()
                    }));

                console.log('selected :>> ', selected);


                if (selected.length === 0) {
                    streamContainer.innerHTML = '<p class="text-center w-100">Please select at least one camera</p>';
                } else {
                    for (const stream of selected) {
                        const videoWrapper = document.createElement('div');
                        videoWrapper.className = 'video-wrapper position-relative';
                        videoWrapper.style.flex = '0 0 auto';


                        Object.entries(cameras).map((item)=> {
                            console.log(item, 'item')
                        });

                       

                        const isOnline = await isStreamReachable(streams[stream.id]);

                        videoWrapper.innerHTML = `
          <div style="position: absolute; top: 0; left: 0; 
                    background-color: rgba(0,0,0,0.7); color: white; 
                    padding: 2px 5px; font-size: 12px; z-index: 10;">
            ${stream.name}
            <span class="camera-status ${isOnline ? 'online' : 'online'}" 
                  style="display: inline-block; margin-left: 5px;"></span>
          </div>
          <iframe src="${streams[stream.id]}" 
                width="100%"
                height="100%"
                  frameborder="0" 
                  allowfullscreen
                    sandbox="allow-scripts allow-same-origin"
                  style="display: block;"></iframe>`;

                        streamContainer.appendChild(videoWrapper);
                    }
                }
            }

            // Set up event listeners
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateStreams);
            });

            // Initial setup
            await updateAllCameraStatuses();
            setInterval(updateAllCameraStatuses, 30000);
        });


        // Generate dropdown HTML dynamically
        function renderCameraDropdown() {
            const dropdown = document.getElementById('cameraDropdown');
            dropdown.innerHTML = ''; // Clear existing

            Object.entries(cameras).forEach(([id, camera]) => {
                const cameraItem = document.createElement('div');
                cameraItem.className = 'camera-item form-check';
                cameraItem.innerHTML = `
                    <input class="form-check-input" 
                        type="checkbox" 
                        id="camera-${id}" 
                        data-stream="stream${id}">
                    <label class="form-check-label camera-label" 
                        for="camera-${id}">${camera.name}</label>
                    <span id="camera-${id}-status" 
                        class="camera-status offline"></span>
      `;
                dropdown.appendChild(cameraItem);
            });
        }

        // Initialize the dropdown
        renderCameraDropdown();

    </script>
</body>
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white" style="letter-spacing: 1px;">Copyright &copy; NetWorklink.Co.Ltd,</p>
    </div>
</footer>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

</html>