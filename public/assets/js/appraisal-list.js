(function () {
    const modal = document.getElementById('appraiserAssignmentModal');
    const form = document.getElementById('appraiserAssignmentForm');
    if (!modal || !form) return;

    const select = document.getElementById('appraiserSelect');
    const reasonField = document.getElementById('assignmentReasonField');
    const reason = document.getElementById('assignmentReason');
    const submit = document.getElementById('assignmentSubmit');
    const feedback = document.getElementById('assignmentFeedback');
    const candidates = {
        Jakarta: ['Rudi Hermawan', 'Siti Permata', 'Dimas Saputra'],
        Bandung: ['Budi Kurniawan', 'Sari Wulandari'],
        Surabaya: ['Andi Pratama', 'Maya Lestari'],
        Bali: ['Made Wirawan', 'Komang Putri']
    };
    let activeRow = null;
    let previousFocus = null;

    function cellText(row, index) {
        return row.cells[index] ? row.cells[index].textContent.trim() : '';
    }

    function openModal(row) {
        activeRow = row;
        previousFocus = document.activeElement;
        const current = cellText(row, 5);
        const branch = cellText(row, 4);
        const isReassign = current !== 'Unassigned';

        modal.querySelector('[data-assignment-application]').textContent = cellText(row, 0);
        modal.querySelector('[data-assignment-borrower]').textContent = cellText(row, 1);
        modal.querySelector('[data-assignment-branch]').textContent = branch;
        modal.querySelector('[data-assignment-current]').textContent = current;
        modal.querySelector('#assignmentTitle').textContent = isReassign ? 'Reassign Appraiser' : 'Assign Appraiser';
        modal.querySelector('#assignmentDescription').textContent = isReassign
            ? 'Select a replacement appraiser and provide a reason for the reassignment.'
            : 'Choose an appraiser to handle this collateral appraisal.';
        reasonField.hidden = !isReassign;
        reason.required = isReassign;
        reason.value = '';
        submit.type = 'submit';
        submit.onclick = null;
        feedback.hidden = true;
        feedback.textContent = '';
        submit.textContent = isReassign ? 'Save Reassignment' : 'Assign Appraiser';

        select.innerHTML = '<option value="">Select an appraiser</option>';
        (candidates[branch] || []).forEach(function (name) {
            const option = document.createElement('option');
            option.value = name;
            option.textContent = name + (name === current ? ' (saat ini)' : '');
            option.disabled = name === current;
            select.appendChild(option);
        });

        modal.hidden = false;
        document.body.classList.add('assignment-modal-open');
        select.focus();
    }

    function closeModal() {
        modal.hidden = true;
        document.body.classList.remove('assignment-modal-open');
        activeRow = null;
        if (previousFocus) previousFocus.focus();
    }

    document.querySelectorAll('[data-appraiser-action]').forEach(function (button) {
        button.addEventListener('click', function () {
            const row = button.closest('tr');
            if (row) openModal(row);
        });
    });

    document.querySelectorAll('[data-open-task]').forEach(function (button) {
        button.addEventListener('click', function () {
            const row = button.closest('tr');
            if (!row || button.disabled) return;
            const query = new URLSearchParams({
                application: cellText(row, 0),
                borrower: cellText(row, 1),
                collateral: cellText(row, 2),
                address: cellText(row, 3),
                branch: cellText(row, 4),
                appraiser: cellText(row, 5),
                status: cellText(row, 7),
                sla: cellText(row, 8)
            });
            window.location.href = button.dataset.taskUrl + '?' + query.toString();
        });
    });

    modal.querySelectorAll('[data-assignment-close]').forEach(function (button) {
        button.addEventListener('click', closeModal);
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && !modal.hidden) closeModal();
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        if (!activeRow || !form.reportValidity()) return;

        const current = cellText(activeRow, 5);
        const chosen = select.value;
        activeRow.cells[5].textContent = chosen;
        activeRow.cells[6].textContent = new Intl.DateTimeFormat('en-GB', {
            day: '2-digit', month: 'short', year: 'numeric', timeZone: 'Asia/Jakarta'
        }).format(new Date());

        if (current === 'Unassigned') {
            const status = activeRow.cells[7].querySelector('.app-list-status');
            if (status) {
                status.textContent = 'Assigned';
                status.className = 'app-list-status app-list-status--active';
            }
        }

        const actionButton = activeRow.querySelector('[data-appraiser-action]');
        if (actionButton) actionButton.textContent = 'Reassign';
        const openTaskButton = activeRow.querySelector('[data-open-task]');
        if (openTaskButton) {
            openTaskButton.disabled = false;
            openTaskButton.removeAttribute('title');
        }
        feedback.textContent = current === 'Unassigned'
            ? chosen + ' has been assigned. This change is only reflected in the prototype display.'
            : 'The appraiser has been changed to ' + chosen + '. This change is only reflected in the prototype display.';
        feedback.hidden = false;
        submit.textContent = 'Selesai';
        submit.type = 'button';
        submit.onclick = closeModal;
    });

})();
