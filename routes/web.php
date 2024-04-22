<?php
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\FaceController;

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\AdminEmployeeController;
use App\Http\Controllers\admin\AdminStudentController;
use App\Http\Controllers\admin\AdminCameraController;
use App\Http\Controllers\admin\AdminGateController;
use App\Http\Controllers\admin\AdminFloodController;

use App\Http\Controllers\admin\AdminAttendanceController;
use App\Http\Controllers\admin\AdminFireController;
use App\Http\Controllers\admin\AdminRoomController;
use App\Http\Controllers\ecr\EcrLoginController;
use App\Http\Controllers\ecr\EcrDashboardController;
use App\Http\Controllers\ecr\EcrCameraController;

use Illuminate\Support\Facades\Route;



//==============================================================================================
//================================== FACE RECOGNITION ROUTES ===================================
//==============================================================================================

Route::get('/', [FaceController::class, 'fetchSmartGate']);
Route::get('/fetch', [FaceController::class, 'fetchGateData']);
Route::post('/save-gate-entry', [FaceController::class, 'saveGateEntry']);

//==============================================================================================
//==================================== ADMINISTRATOR ROUTES ====================================
//==============================================================================================

// administrator login routes
Route::get('/admin', function () {
    return view('/admin/login');
})->name('login');
Route::post("/admin/login", [AdminLoginController::class, 'adminLogin']);

// administrator dashboard routes
Route::get("/admin/dashboard", [AdminDashboardController::class, 'fetchAdminDashboard'])->middleware('auth');
Route::get('/admin/dashboard/fetch', [AdminDashboardController::class, 'fetchAdminDashboardData'])->middleware('auth');
Route::post('/admin/dashboard/send', [AdminDashboardController::class, 'sendBroadcastMessage'])->middleware('auth');
Route::post('/admin/dashboard/send-message', [AdminDashboardController::class, 'sendMessage'])->middleware('auth');
Route::post('/admin/dashboard/detect-fire', [AdminDashboardController::class, 'detectFire'])->middleware('auth');
Route::post('/admin/dashboard/save-flood', [AdminDashboardController::class, 'saveFlood'])->middleware('auth');


// administrator employees routes
Route::get("/admin/employees", [AdminEmployeeController::class, 'fetchEmployees'])->middleware('auth');
Route::post("/admin/employees/add", [AdminEmployeeController::class, 'addEmployee'])->middleware('auth');
Route::post("/admin/employees/edit", [AdminEmployeeController::class, 'editEmployee'])->middleware('auth');
Route::get("/admin/employees/delete/{id}", [AdminEmployeeController::class, 'deleteEmployee'])->middleware('auth');
Route::post("/admin/employees/add-face", [AdminEmployeeController::class, 'addFace'])->middleware('auth');

// administrator students routes
Route::get("/admin/students", [AdminStudentController::class, 'fetchStudents'])->middleware('auth');
Route::post("/admin/students/add", [AdminStudentController::class, 'addStudent'])->middleware('auth');
Route::post("/admin/students/edit", [AdminStudentController::class, 'editStudent'])->middleware('auth');
Route::get("/admin/students/delete/{id}", [AdminStudentController::class, 'deleteStudent'])->middleware('auth');
Route::post("/admin/students/add-face", [AdminStudentController::class, 'addFace'])->middleware('auth');

// administrator camera routes
Route::get("/admin/cameras", [AdminCameraController::class, 'fetchCameras'])->middleware('auth');
Route::post("/admin/cameras/add", [AdminCameraController::class, 'addCamera'])->middleware('auth');
Route::get("/admin/cameras/live/{id}", [AdminCameraController::class, 'viewCamera'])->middleware('auth');
Route::get('/admin/cameras/live/find/{id}', [AdminCameraController::class, 'findFaceId'])->middleware('auth');
Route::get('/admin/cameras/live/fetch/{id}', [AdminCameraController::class, 'fetchESP32CameraFrame'])->middleware('auth');
Route::get("/admin/cameras/delete/{id}", [AdminCameraController::class, 'deleteCamera'])->middleware('auth');
Route::get('/admin/cameras/rtsp', function () {
    return view('admin/rtsp');
})->middleware('auth');
Route::get("/admin/cameras/videos/{id}", [AdminCameraController::class, 'fetchVideos'])->middleware('auth');


// administrator gate routes
Route::get("/admin/gate", [AdminGateController::class, 'fetchGate'])->middleware('auth');

// administrator room routes
Route::get("/admin/rooms", [AdminRoomController::class, 'fetchRooms'])->middleware('auth');
Route::post("/admin/rooms/add", [AdminRoomController::class, 'addRoom'])->middleware('auth');
Route::post("/admin/rooms/edit", [AdminRoomController::class, 'editRoom'])->middleware('auth');
Route::get("/admin/rooms/delete/{id}", [AdminRoomController::class, 'deleteRoom'])->middleware('auth');

// administrator attendace routes
Route::get("/admin/attendance", [AdminAttendanceController::class, 'fetchAttendance'])->middleware('auth');

// administrator  fire routes
Route::get("/admin/fire", [AdminFireController::class, 'fetchFire'])->middleware('auth');
Route::post("/admin/fire/add", [AdminFireController::class, 'addModule'])->middleware('auth');
Route::get("/admin/fire/delete/{id}", [AdminFireController::class, 'deleteModule'])->middleware('auth');
Route::get("/admin/fire/logs/{id}", [AdminFireController::class, 'fetchFirelogs'])->middleware('auth');

// administrator flood routes
Route::get("/admin/flood", [AdminFloodController::class, 'fetchFlood'])->middleware('auth');
Route::post("/admin/flood/add", [AdminFloodController::class, 'addModule'])->middleware('auth');
Route::get("/admin/flood/delete/{id}", [AdminFloodController::class, 'deleteModule'])->middleware('auth');
Route::get("/admin/flood/logs/{id}", [AdminFloodController::class, 'fetchFloodlogs'])->middleware('auth');


// administrator logout route
Route::get('/admin/logout', function () {
    if (session()->has('administrator')) {
        session()->pull('administrator');
        session()->flush();

    }
    return redirect('/admin');
});
//==============================================================================================
//==================================== ADMINISTRATOR ROUTES ====================================
//==============================================================================================
//

//==============================================================================================
//========================================= ECR ROUTES =========================================
//==============================================================================================

// ecr login routes
Route::get('/ecr', function () {
    return view('/ecr/login');
});


// Route::post("/ecr/login", [EcrLoginController::class, 'ecrLogin']);

// ecr dashboard routes
Route::get("/ecr/dashboard", [EcrDashboardController::class, 'fetchECRDashboard'])->middleware('auth');
Route::get('/ecr/dashboard/fetch', [EcrDashboardController::class, 'fetchECRDashboardData'])->middleware('auth');
Route::get('/ecr/dashboard/send', [EcrDashboardController::class, 'sendECRBroadcastMessage'])->middleware('auth');

// ecr camera routes
Route::get("/ecr/cameras", [EcrCameraController::class, 'fetchCameras'])->middleware('auth');
// Route::post("/ecr/cameras/add", [EcrCameraController::class, 'addCamera']);
Route::get("/ecr/cameras/live/{id}", [EcrCameraController::class, 'viewCamera'])->middleware('auth');
Route::get('/ecr/cameras/live/find/{id}', [EcrCameraController::class, 'findFaceId'])->middleware('auth');
Route::get('/ecr/cameras/live/fetch/{id}', [EcrCameraController::class, 'fetchESP32CameraFrame'])->middleware('auth');


// Route::post("ecr/cameras/delete", [EcrCameraController::class, 'deleteCamera']);

//==============================================================================================
//========================================= ECR ROUTES =========================================
//==============================================================================================



//=============================================================================================
// CAMERAS CONTROLLER =========================================================================
//=============================================================================================
// Route::get("/ecr/cameras", [EcrCameraController::class, 'fetchCameras']);
// Route::post("/ecr/cameras/add", [EcrCameraController::class, 'addCamera']);
// Route::get("/ecr/cameras/live/{id}", [EcrCameraController::class, 'viewCamera']);
// Route::get('/ecr/cameras/live/find/{id}', [EcrCameraController::class, 'findFaceId']);
// Route::get('/ecr/cameras/live/fetch/{id}', [EcrCameraController::class, 'fetchESP32CameraFrame']);
// Route::post("ecr/cameras/delete", [EcrCameraController::class, 'deleteCamera']);
//=============================================================================================
// CAMERAS CONTROLLER =========================================================================
//=============================================================================================



