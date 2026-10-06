<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Home::index');
$routes->get('app-data', 'Home::appData');
$routes->get('app-list', 'Home::appList');
$routes->get('drafts', 'Home::drafts');
$routes->get('draft-appraisal', 'Home::draftAppraisal');
$routes->get('returned-app', 'Home::returnedApp');
$routes->get('appraisal-list', 'Home::appraisalList');
$routes->get('appraisal-task', 'Home::appraisalTask');
$routes->get('asset-appraisal-summary', 'Home::assetAppraisalSummary');
$routes->get('appraisal-upload', 'Home::appraisalUpload');
$routes->get('appraisal-review', 'Home::appraisalReview');
