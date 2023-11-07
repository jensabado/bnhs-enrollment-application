<?php 

$routes->group('admin', function($routes) {
  $routes->group('', ['filter' => 'admin:auth'], function($routes) {
    $routes->get('', 'AdminController::index', ['as' => 'admin.home']);
    $routes->get('logout', 'AdminController::logout', ['as' => 'admin.logout']);
    // BUILDING
    $routes->get('building', 'BuildingController::index', ['as' => 'admin.building']);
    $routes->post('building-data', 'BuildingController::datatable', ['as' => 'admin.building-data']);
    $routes->post('add-building', 'BuildingController::addBuilding', ['as' => 'admin.add-building']);
    $routes->post('get-building-data', 'BuildingController::getBuildingData', ['as' => 'admin.get-building-data']);
    $routes->post('edit-building', 'BuildingController::editBuilding', ['as' => 'admin.edit-building']);
    $routes->post('delete-building', 'BuildingController::deleteBuilding', ['as' => 'admin.delete-building']);
    // ROOM
    $routes->get('room', 'RoomController::room', ['as' => 'admin.room']);
    $routes->post('room-data', 'RoomController::datatable', ['as' => 'admin.room-data']);
    $routes->post('add-room', 'RoomController::addRoom', ['as' => 'admin.add-room']);
    $routes->post('get-room-data', 'RoomController::getRoomData', ['as' => 'admin.get-room-data']);
    $routes->post('edit-room', 'RoomController::editRoom', ['as' => 'admin.edit-room']);
    $routes->post('delete-room', 'RoomController::deleteRoom', ['as' => 'admin.delete-room']);
    // SECTION
    $routes->get('section', 'SectionController::section', ['as' => 'admin.section']);
    $routes->post('get-room-option', 'SectionController::getRoomOption', ['as' => 'admin.get-room-option']);
    $routes->post('section-data', 'SectionController::datatable', ['as' => 'admin.section-data']);
    $routes->post('add-section', 'SectionController::addSection', ['as' => 'admin.add-section']);
    $routes->post('get-section-data', 'SectionController::getSectionData', ['as' => 'admin.get-section-data']);
    $routes->post('edit-section', 'SectionController::editSection', ['as' => 'admin.edit-section']);
    $routes->post('delete-section', 'SectionController::deleteSection', ['as' => 'admin.delete-section']);
    // SUBJECT
    $routes->get('subject', 'SubjectController::subject', ['as' => 'admin.subject']);
    $routes->post('subject-data', 'SubjectController::datatable', ['as' => 'admin.subject-data']);
    $routes->post('add-subject', 'SubjectController::addSubject', ['as' => 'admin.add-subject']);
    $routes->post('get-subject-data', 'SubjectController::getSubjectData', ['as' => 'admin.get-subject-data']);
    $routes->post('edit-subject', 'SubjectController::editSubject', ['as' => 'admin.edit-subject']);
    $routes->post('delete-subject', 'SubjectController::deleteSubject', ['as' => 'admin.delete-subject']);
    // TEACHER
    $routes->get('teacher', 'TeacherController::teacher', ['as' => 'admin.teacher']);
    $routes->post('teacher-data', 'TeacherController::datatable', ['as' => 'admin.teacher-data']);
    $routes->post('add-teacher', 'TeacherController::addTeacher', ['as' => 'admin.add-teacher']);
    $routes->post('get-teacher-data', 'TeacherController::getTeacherData', ['as' => 'admin.get-teacher-data']);
    $routes->post('edit-teacher', 'TeacherController::editTeacher', ['as' => 'admin.edit-teacher']);
    $routes->post('delete-teacher', 'TeacherController::deleteTeacher', ['as' => 'admin.delete-teacher']);
    $routes->post('disable-teacher', 'TeacherController::disable', ['as' => 'admin.disable-teacher']);
    $routes->post('enable-teacher', 'TeacherController::enable', ['as' => 'admin.enable-teacher']);
    // TEACHER SUBJECT
    $routes->get('teacher-subject', 'TeacherSubjectController::teacherSubject', ['as' => 'admin.teacher-subject']);
    $routes->post('teacher-subject-data', 'TeacherSubjectController::datatable', ['as' => 'admin.teacher-subject-data']);
    $routes->post('add-teacher-subject', 'TeacherSubjectController::addTeacherSubject', ['as' => 'admin.add-teacher-subject']);
    $routes->post('get-teacher-subject-data', 'TeacherSubjectController::getTeacherSubjectData', ['as' => 'admin.get-teacher-subject-data']);
    $routes->post('edit-teacher-subject', 'TeacherSubjectController::editTeacherSubject', ['as' => 'admin.edit-teacher-subject']);
    $routes->post('delete-teacher-subject', 'TeacherSubjectController::deleteTeacherSubject', ['as' => 'admin.delete-teacher-subject']);
    $routes->post('get-subject-option', 'TeacherSubjectController::getSubjectOption', ['as' => 'admin.get-subject-option']);
    // CLASS ADVISORY
    $routes->get('class-advisory', 'ClassAdvisoryController::classAdvisory', ['as' => 'admin.class-advisory']);
    $routes->post('class-advisory-data', 'ClassAdvisoryController::datatable', ['as' => 'admin.class-advisory-data']);
    $routes->post('add-class-advisory', 'ClassAdvisoryController::addClassAdvisory', ['as' => 'admin.add-class-advisory']);
    $routes->post('get-class-advisory-data', 'ClassAdvisoryController::getClassAdvisoryData', ['as' => 'admin.get-class-advisory-data']);
    $routes->post('edit-class-advisory', 'ClassAdvisoryController::editClassAdvisory', ['as' => 'admin.edit-class-advisory']);
    $routes->post('delete-class-advisory', 'ClassAdvisoryController::deleteClassAdvisory', ['as' => 'admin.delete-class-advisory']);
    $routes->post('get-section-option', 'ClassAdvisoryController::getSectionOption', ['as' => 'admin.get-section-option']);
    // CLASS SCHEDULE
    $routes->get('classroom-schedule', 'ClassroomScheduleController::classroomSchedule', ['as' => 'admin.classroom-schedule']);
    $routes->post('classroom-schedule-data', 'ClassroomScheduleController::datatable', ['as' => 'admin.classroom-schedule-data']);
    $routes->post('add-classroom-schedule', 'ClassroomScheduleController::addClassroomSchedule', ['as' => 'admin.add-classroom-schedule']);
    $routes->post('get-classroom-schedule-data', 'ClassroomScheduleController::getClassroomScheduleData', ['as' => 'admin.get-classroom-schedule-data']);
    $routes->post('edit-classroom-schedule', 'ClassroomScheduleController::editClassroomSchedule', ['as' => 'admin.edit-classroom-schedule']);
    $routes->post('delete-classroom-schedule', 'ClassroomScheduleController::deleteClassroomSchedule', ['as' => 'admin.delete-classroom-schedule']);
    $routes->post('get-section-option', 'ClassroomScheduleController::getSectionOption', ['as' => 'admin.get-section-option']);
    $routes->post('get-subject-option', 'ClassroomScheduleController::getSubjectOption', ['as' => 'admin.get-subject-option']);
    $routes->post('get-teacher-option', 'ClassroomScheduleController::getTeacherOption', ['as' => 'admin.get-teacher-option']);
    $routes->get('classroom-schedule-print/(:any)', 'ClassroomScheduleController::getPrint/$1', ['as' => 'admin.classroom-schedule-print']);
    // GRADE 7 ENROLLEES
    $routes->get('enrollees/grade-7', 'EnrolleesController::index', ['as' => 'admin.enrollees/grade-7']);
    $routes->post('enrollees/grade-7-data', 'EnrolleesController::grade7Datatable', ['as' => 'admin.enrollees/grade-7-data']);
    $routes->get('enrollees/grade-7/view/(:any)', 'EnrolleesController::grade7View/$1', ['as' => 'admin.enrollees/grade-7/view']);
    $routes->post('update-enrollees-status', 'EnrolleesController::updateStatus', ['as' => 'admin.update-enrollees-status']);
  });

  $routes->group('', ['filter' => 'admin:guest'], function($routes) {
    $routes->get('login', 'AdminController::login', ['as' => 'admin.login']);
    $routes->post('login-handler', 'AdminController::loginHandler', ['as' => 'admin.login-handler']);
  });
});