<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('dashboard');
    }
    public function appData()
    {
        return view('app-data');
    }
    public function appList()
    {
        return view('app-list');
    }
    public function drafts()
    {
        return view('drafts');
    }
    public function draftAppraisal()
    {
        return view('draft-appraisal');
    }
    public function returnedApp()
    {
        return view('returned-app');
    }
    public function appraisalList()
    {
        return view('appraisal-list');
    }
    public function appraisalTask()
    {
        return view('appraisal-task', [
            'applicationNo' => $this->request->getGet('application') ?? '',
            'borrower' => $this->request->getGet('borrower') ?? '',
            'collateral' => $this->request->getGet('collateral') ?? '',
            'address' => $this->request->getGet('address') ?? '',
            'branch' => $this->request->getGet('branch') ?? '',
            'appraiser' => $this->request->getGet('appraiser') ?? '',
            'status' => $this->request->getGet('status') ?? '',
            'sla' => $this->request->getGet('sla') ?? '',
        ]);
    }
    public function assetAppraisalSummary()
    {
        return view('asset-appraisal-summary', [
            'applicationNo' => $this->request->getGet('application') ?? '',
            'borrower' => $this->request->getGet('borrower') ?? '',
            'collateral' => $this->request->getGet('collateral') ?? '',
            'address' => $this->request->getGet('address') ?? '',
            'branch' => $this->request->getGet('branch') ?? '',
            'appraiser' => $this->request->getGet('appraiser') ?? '',
            'surveyDate' => $this->request->getGet('survey_date') ?? '',
        ]);
    }
    public function appraisalUpload()
    {
        return view('appraisal-upload', [
            'applicationNo' => $this->request->getGet('application') ?? '',
            'borrower' => $this->request->getGet('borrower') ?? '',
            'collateral' => $this->request->getGet('collateral') ?? '',
            'address' => $this->request->getGet('address') ?? '',
            'branch' => $this->request->getGet('branch') ?? '',
            'appraiser' => $this->request->getGet('appraiser') ?? '',
        ]);
    }
    public function appraisalReview()
    {
        return view('appraisal-review', [
            'applicationNo' => $this->request->getGet('application') ?? '',
            'borrower' => $this->request->getGet('borrower') ?? '',
            'collateral' => $this->request->getGet('collateral') ?? '',
            'address' => $this->request->getGet('address') ?? '',
            'branch' => $this->request->getGet('branch') ?? '',
            'appraiser' => $this->request->getGet('appraiser') ?? '',
        ]);
    }
}
