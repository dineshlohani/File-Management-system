var ST = jQuery.noConflict();
	ST(document).ready(function(){
		ST('#nepaliDate5').nepaliDatePicker({
			npdMonth: true,
			npdYear: true,
			npdYearCount: 10
		});
		ST('#nepaliDate9').nepaliDatePicker({
			npdMonth: true,
			npdYear: true,
			npdYearCount: 10
		});
		ST('#nepaliDate').nepaliDatePicker({
			ndpEnglishInput: 'englishDate'
		});
		ST('#nepaliDate1').nepaliDatePicker({
			onChange: function(){
				alert(ST('#nepaliDate1').val());
			}
		});
		ST('#nepaliDate2').nepaliDatePicker();
		ST('#nepaliDate3').nepaliDatePicker({
			onFocus: false,
			npdMonth: true,
			npdYear: true,
			ndpTriggerButton: true,
			ndpTriggerButtonText: 'मिति',
			ndpTriggerButtonClass: 'btn btn-sm'
		});

		ST('#englishDate').change(function(){
			ST('#nepaliDate').val(AD2BS(ST('#englishDate').val()));
		});

		ST('#englishDate9').change(function(){
			ST('#nepaliDate9').val(AD2BS(ST('#englishDate9').val()));
		});

		ST('#nepaliDate9').change(function(){
			ST('#englishDate9').val(BS2AD(ST('#nepaliDate9').val()));
		});
	});
