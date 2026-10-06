(function () {
    const form = document.getElementById('assetAppraisalSummaryForm');
    if (!form) return;

    const feedback = document.getElementById('assetSummaryFeedback');
    const percentage = document.getElementById('liquidationPercent');
    const justification = document.getElementById('liquidationJustification');
    const finalBasis = document.getElementById('finalBasis');
    const surveyDate = document.getElementById('surveyDate');
    const reportDate = document.getElementById('reportDate');
    const money = new Intl.NumberFormat('en-US', { maximumFractionDigits: 0 });

    function reportNumber() {
        const month = new Date().getMonth() + 1;
        const romanMonths = ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        document.getElementById('reportNumber').textContent = '001/AGGRE-APPRAISAL/' + romanMonths[month] + '/' + new Date().getFullYear();
    }

    function update() {
        const rate = Math.max(0, Number(percentage.value) || 0) / 100;
        document.querySelectorAll('[data-basis-card]').forEach(function (card) {
            const basis = card.dataset.basisCard;
            let market = 0;
            card.querySelectorAll('[data-value-row]').forEach(function (row) {
                const area = Number(row.querySelector('[data-area-input="' + basis + '"]').value) || 0;
                const unitRate = Number(row.querySelector('[data-rate-input="' + basis + '"]').value) || 0;
                const rowMarket = area * unitRate;
                market += rowMarket;
                row.querySelector('[data-row-market]').textContent = 'IDR ' + money.format(rowMarket);
                row.querySelector('[data-row-liquidation]').textContent = 'IDR ' + money.format(rowMarket * rate);
            });
            card.querySelector('[data-market-total="' + basis + '"]').textContent = 'IDR ' + money.format(market);
            card.querySelector('[data-liquidation-total="' + basis + '"]').textContent = 'IDR ' + money.format(market * rate);
        });

        const selected = finalBasis.value;
        const basisCard = document.querySelector('[data-basis-card="' + selected + '"]');
        document.getElementById('finalMarketValue').textContent = basisCard.querySelector('[data-market-total="' + selected + '"]').textContent;
        document.getElementById('finalLiquidationValue').textContent = basisCard.querySelector('[data-liquidation-total="' + selected + '"]').textContent;

        const changed = Number(percentage.value) !== 60;
        justification.required = changed;
        justification.setCustomValidity(changed && !justification.value.trim() ? 'Provide a justification when changing the default 60%.' : '');
    }

    document.querySelectorAll('[data-area-input], [data-rate-input]').forEach(function (input) {
        input.addEventListener('input', update);
    });
    percentage.addEventListener('input', update);
    justification.addEventListener('input', update);
    finalBasis.addEventListener('change', update);
    surveyDate.addEventListener('change', function () { reportDate.min = surveyDate.value; });
    reportDate.addEventListener('change', function () {
        if (surveyDate.value) reportDate.min = surveyDate.value;
    });
    document.getElementById('saveAssetSummary').addEventListener('click', function () {
        feedback.textContent = 'Draft captured in this prototype. It has not been saved to the server.';
        feedback.hidden = false;
    });
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        reportDate.min = surveyDate.value;
        if (!form.reportValidity()) return;
        try {
            sessionStorage.setItem('appraisalReview:assetSummary', JSON.stringify({
                reportNumber: document.getElementById('reportNumber').textContent,
                surveyDate: surveyDate.value,
                reportDate: reportDate.value,
                valuationPurpose: document.getElementById('valuationPurpose').selectedOptions[0].text,
                appraiser: document.getElementById('summaryAppraiser').value,
                correctionNote: document.getElementById('fieldCorrectionNote').value,
                liquidationPercent: percentage.value,
                finalBasis: finalBasis.selectedOptions[0].text,
                marketValue: document.getElementById('finalMarketValue').textContent,
                liquidationValue: document.getElementById('finalLiquidationValue').textContent
            }));
        } catch (error) {}
        const source = new URLSearchParams(window.location.search);
        const next = new URLSearchParams({
            application: source.get('application') || '',
            borrower: source.get('borrower') || '',
            collateral: source.get('collateral') || '',
            address: source.get('address') || '',
            branch: source.get('branch') || '',
            appraiser: source.get('appraiser') || document.getElementById('summaryAppraiser').value || ''
        });
        window.location.href = form.dataset.uploadUrl + '?' + next.toString();
    });

    reportNumber();
    reportDate.min = surveyDate.value;
    update();
})();
