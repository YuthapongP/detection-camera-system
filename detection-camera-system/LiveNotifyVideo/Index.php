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
    #cameraDropdown {
        max-width: 400px;
        max-height: 200px;
        overflow-y: auto;
    }

    .camera-status {
        height: 15px;
        width: 15px;
        border-radius: 50%;
        display: inline-block;
        margin-left: auto;
    }

    .online {
        background-color: limegreen;
    }

    .offline {
        background-color: red;
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
        <!-- Dropdown Content -->
        <div class="container text-center mt-3 position-relative">
            <!-- Added position-relative -->
            <!-- Button -->
            <button class="btn btn-outline-dark mb-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#cameraDropdown">
                Select Camera
            </button>

            <!-- Dropdown Content - Now properly centered -->
            <div id="cameraDropdown" class="dropdown-menu p-3 mx-auto"
                style="width: 300px; left: 50%; transform: translateX(-50%);">
                <!-- Camera Items -->
                <div class="camera-item form-check">
                    <input class="form-check-input" type="checkbox" id="cam1">
                    <label class="form-check-label camera-label" for="cam1">Camera 1</label>
                    <span class="camera-status offline"></span>
                </div>
                <div class="camera-item form-check">
                    <input class="form-check-input" type="checkbox" id="cam2" checked>
                    <label class="form-check-label camera-label" for="cam2">Camera 2</label>
                    <span class="camera-status online"></span>
                </div>
                <div class="camera-item form-check">
                    <input class="form-check-input" type="checkbox" id="cam1">
                    <label class="form-check-label camera-label" for="cam1">Camera 1</label>
                    <span class="camera-status offline"></span>
                </div>
                <div class="camera-item form-check">
                    <input class="form-check-input" type="checkbox" id="cam2" checked>
                    <label class="form-check-label camera-label" for="cam2">Camera 2</label>
                    <span class="camera-status online"></span>
                </div>
                <div class="camera-item form-check">
                    <input class="form-check-input" type="checkbox" id="cam1">
                    <label class="form-check-label camera-label" for="cam1">Camera 1</label>
                    <span class="camera-status offline"></span>
                </div>
                <div class="camera-item form-check">
                    <input class="form-check-input" type="checkbox" id="cam2" checked>
                    <label class="form-check-label camera-label" for="cam2">Camera 2</label>
                    <span class="camera-status online"></span>
                </div>
                <div class="camera-item form-check">
                    <input class="form-check-input" type="checkbox" id="cam1">
                    <label class="form-check-label camera-label" for="cam1">Camera 1</label>
                    <span class="camera-status offline"></span>
                </div>
                <div class="camera-item form-check">
                    <input class="form-check-input" type="checkbox" id="cam2" checked>
                    <label class="form-check-label camera-label" for="cam2">Camera 2</label>
                    <span class="camera-status online"></span>
                </div>
                <div class="camera-item form-check">
                    <input class="form-check-input" type="checkbox" id="cam1">
                    <label class="form-check-label camera-label" for="cam1">Camera 1</label>
                    <span class="camera-status offline"></span>
                </div>
                <div class="camera-item form-check">
                    <input class="form-check-input" type="checkbox" id="cam2" checked>
                    <label class="form-check-label camera-label" for="cam2">Camera 2</label>
                    <span class="camera-status online"></span>
                </div>
            </div>
        </div>

        <!-- <div class="container px-lg-5">
            <div class="p-4 p-lg-5 bg-light streamdiv rounded-3 text-center " style="background-color: #f7f7f7; height: 950px;">
                <div class="row justify-content-center align-items-center" id="streaming-box">
                    <div class="p-0">
                        <iframe allowfullscreen src="../Vdo1/" class="iframe" scrolling="no" frameborder="0"></iframe>
                    </div>

                    <div class="col-md-12 btn-box pt-3 d-flex align-items-center bottom-bar" style="gap: 1rem;">
                        <div class="col-md-6 d-flex snap-btn" style="justify-content: flex-end; padding: 3px 0;">
                        <button type="button" <?php if ($getparam === '') {
                            echo "style='display: none;'";
                        } ?> class="btn btn-lg btn-secondary btn-snap" onclick="location.href='<?= $urlimg; ?>'">SNAP SHOT</button>
                        </div>
                        <div class="col-md-6 d-flex vdo-btn" style="justify-content: flex-start; padding: 3px 0;">
                        <button type="button" <?php if ($getparam === '') {
                            echo "style='display: none;'";
                        } ?> class="btn btn-lg btn-secondary btn-vdo" onclick="location.href='<?= $urlvdo; ?>'">VDO SNAP</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="text-center" style="width: 150px; height: 100px">
            <iframe src="https://www.youtube.com/embed/YE7VzlLtp-4" frameborder="0" allowfullscreen>
            </iframe>
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


    </script>
</body>
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white" style="letter-spacing: 1px;">Copyright &copy; NetWorklink.Co.Ltd,</p>
    </div>
</footer>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>

</html>