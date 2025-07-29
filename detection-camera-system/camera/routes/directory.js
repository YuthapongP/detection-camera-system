const express = require('express')
const { GetLogsData } = require('../controllers/getLogs')
const { insertPowerLogs, getUserIDCustomer, getUserIDCustomerexternal, getDataFlutter, checkDbConnection } = require('../controllers/DatabaseManage')
const { delayEventFunct } = require('../middlefunct/DelaySendLineFunct')
const { manageDirectory } = require('../controllers/directory')
const router = express.Router()

router.get('/getuserid/', getUserIDCustomerexternal)
router.get('/getDataFlutter/', getDataFlutter)
router.get('/directory/:camname', delayEventFunct, manageDirectory)
// router.get('/directory/', manageDirectory)
router.get('/getlogs/:params', GetLogsData)

router.get('/check-db-connection', checkDbConnection)

router.post('/powerlogs/:point/:status/:val/:timestamp/', insertPowerLogs)

module.exports = router