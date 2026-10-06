(function () {
    const form = document.getElementById('appraisalTaskForm');
    if (!form) return;

    const feedback = document.getElementById('appraisalTaskFeedback');
    const saveButton = document.getElementById('saveAppraisalDraft');
    const appraiserType = document.getElementById('appraiserType');
    const internalField = document.getElementById('internalAppraiserField');
    const internalSelect = document.getElementById('internalAppraiser');
    const externalField = document.getElementById('externalKjppField');
    const externalInput = document.getElementById('externalKjpp');
    const outcome = document.getElementById('visitOutcome');
    const rescheduleFields = document.getElementById('rescheduleFields');
    const failureReason = document.getElementById('failureReason');
    const rescheduleDateTime = document.getElementById('rescheduleDateTime');
    const saveVisitButton = document.getElementById('saveVisitDetails');

    function toggleField(field, visible) {
        field.hidden = !visible;
        field.style.display = visible ? 'flex' : 'none';
    }

    appraiserType.addEventListener('change', function () {
        const isInternal = appraiserType.value === 'internal';
        const isExternal = appraiserType.value === 'external';
        toggleField(internalField, isInternal);
        internalSelect.required = isInternal;
        internalSelect.disabled = !isInternal;
        toggleField(externalField, isExternal);
        externalInput.required = isExternal;
        externalInput.disabled = !isExternal;
    });

    outcome.addEventListener('change', function () {
        const needsReschedule = outcome.value === 'reschedule';
        rescheduleFields.hidden = !needsReschedule;
        rescheduleFields.style.display = needsReschedule ? 'grid' : 'none';
        failureReason.required = needsReschedule;
        failureReason.disabled = !needsReschedule;
        rescheduleDateTime.required = needsReschedule;
        rescheduleDateTime.disabled = !needsReschedule;
        saveVisitButton.textContent = needsReschedule ? 'Save Reschedule' : 'Continue to Asset Appraisal Summary';
    });

    saveButton.addEventListener('click', function () {
        feedback.textContent = 'The scheduling and site visit draft is recorded in this prototype. It has not been saved to the server.';
        feedback.hidden = false;
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        if (!form.reportValidity()) return;
        if (outcome.value === 'reschedule') {
            feedback.textContent = 'The failed survey and rescheduled visit are recorded in this prototype. The data has not been saved, and Marketing has not been notified.';
        } else {
            feedback.textContent = 'The schedule and successful visit outcome are recorded in this prototype. Continue to prepare the asset appraisal summary.';
            const source = new URLSearchParams(window.location.search);
            const values = {
                application: source.get('application') || '',
                borrower: source.get('borrower') || '',
                collateral: source.get('collateral') || '',
                address: source.get('address') || '',
                branch: source.get('branch') || '',
                appraiser: appraiserType.value === 'internal' ? internalSelect.value : externalInput.value,
                survey_date: document.getElementById('surveyDateTime').value.slice(0, 10)
            };
            try {
                sessionStorage.setItem('appraisalReview:siteVisit', JSON.stringify({
                    appraiserType: appraiserType.options[appraiserType.selectedIndex].text,
                    appraiser: appraiserType.value === 'internal' ? internalSelect.value : externalInput.value,
                    scheduledAt: document.getElementById('surveyDateTime').value,
                    contactName: document.getElementById('siteContactName').value,
                    contactPhone: document.getElementById('siteContactPhone').value,
                    visitOutcome: outcome.options[outcome.selectedIndex].text
                }));
            } catch (error) {}
            const next = new URLSearchParams(values);
            window.location.href = form.dataset.summaryUrl + '?' + next.toString();
        }
        feedback.hidden = false;
    });

    toggleField(internalField, false);
    toggleField(externalField, false);
    rescheduleFields.style.display = 'none';
})();
