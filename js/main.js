var basepath = "http://localhost/php";

$.backstretch('http://localhost/php/images/background.jpg');

$(document).on('ready', function() {
    //$("#student_thumb").fileinput(
	//	{
     //       uploadAsync: false,
     //       uploadUrl: "/path/to/upload.php",
	//		showCaption: false,
	//		initialPreview: [
	//			"<img src='http://placehold.it/200x200' class='file-preview-image' alt='Student Thumb' title='Student Thumb'>",
	//		],
	//		showClose : false,
	//		allowedFileTypes: ['image'],
	//		allowedFileExtensions:['png'],
	//		maxFileCount: 1
	//	}
	//);
    var btnCust = '<button type="button" class="btn btn-default" title="Add picture tags" ' +
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>';
    $("#student_thumb").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        defaultPreviewContent: '<img src="'+basepath+'/images/default_avatar_male.jpg" alt="Your Avatar" style="width:160px">',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });
});



var radioselect1 = $('input[name=ssc_type]');
var radioselect2 = $('input[name=hsc_type]');


var ssc_div = $('.ssc_container');
var o_level_div = $('.o_level_container');

var hsc_div = $('.hsc_container');
var a_level_div = $('.a_level_container');
var diploma_div = $('.diploma_container');


$(window).load(function(){
	var edu_type1 = $('input[name=ssc_type]:checked').val();
	var edu_type2 = $('input[name=hsc_type]:checked').val();
	show_edu(edu_type1, 1);
	show_edu(edu_type2, 2);
});

radioselect1.change(function (){
	var edu_type1 = $(this).val();
	show_edu(edu_type1, 1);	
});	
radioselect2.change(function (){	
	var edu_type2 = $(this).val();
	show_edu(edu_type2, 2);
});

function show_edu(type, cat){	
	if(cat == 1){
		if(type == 'ssc'){
			ssc_div.show();
			o_level_div.hide();
		}
		else if(type == 'o_level'){
			o_level_div.show();
			ssc_div.hide();			
		}
	}
	else if(cat == 2){				
		if(type == 'hsc'){
			hsc_div.show();
			a_level_div.hide();
			diploma_div.hide();
		}
		else if(type == 'a_level'){
			a_level_div.show();
			hsc_div.hide();
			diploma_div.hide();
			
		}
		else if(type == 'diploma'){
			diploma_div.show();
			a_level_div.hide();
			hsc_div.hide();			
		}
	}	
}

// GET BATCH NUMBERS FOR A COURSE IN RESULT
$('.result_select_course').on('change', function(){
	$.ajax(
		{
			url: 'function.php',
			method: 'POST',
			data: {'course_id': this.value, 'get_batch_of_course':1},
			success: function(data){
				var html = "";
				for(var i=1; i<=data; i++){
					html+="<option value='"+i+"'>"+i+"</option>";
				}
				$('.result_select_batch').html(html);
			}
		}
	);
});

// GET ALL SUBJECT OF SELECTED SEMESTER FOR A COURSE IN RESULT
$('.result_select_sems').on('change', function(){
    $.ajax(
        {
            url: 'function.php',
            method: 'POST',
            data: {'course_id': $('.result_select_course').find('option:selected').val(), 'semester_id': this.value,  'get_subject_of_course':1},
            success: function(d){
                var html = "";
                var html2 = "";
                var data = JSON.parse(d);
                for(var i=0; i<data['subjects'].length; i++){
                    html+="<option value='"+data['subjects'][i]['id']+"'>"+data['subjects'][i]['subject_name']+"</option>";
                }
                $('.result_select_subject').html(html);

                for(var i=0; i<data['students'].length; i++){
                    html2+="<option value='"+data['students'][i]['id']+"'>"+data['students'][i]['applicant_name']+" - "+data['students'][i]['id']+"</option>";
                }
                $('.result_student_id').html(html2);
            }
        }
    );
});

var cont = $('.result_sems').val();
if(typeof cont != 'undefined') {
    getResult(cont);
}
$('.result_sems').on('change', function(){
    $('.result_trs').html("<tr><td colspan='3'>Please Wait...</td></tr>");
    getResult(this.value);
});

function getResult(val){
    $.ajax(
        {
            url: 'http://localhost/php/admin/function.php',
            method: 'POST',
            data: {'student_id': $('.result_student_id').val(), 'semester': val,  'get_result_of_course':1},
            success: function(d){
                var container = $('.result_trs');
                var data = JSON.parse(d);
                if(data.length > 0){
                    var html="";
                    for(var i=0; i<data.length; i++){
                        console.log(data[i]);
                        html += "<tr><td>"+data[i]['subject_name']+"</td><td>"+data[i]['subject_credit']+"</td><td>"+data[i]['cgpa']+"</td></tr>";
                    }
                    console.log(html);
                    container.html(html);
                }
                else{
                    container.html("<tr><td colspan='3'>No Result</td></tr>");
                }
            }
        }
    );
}




var height = $(document).height();
$('.form-box').css('min-height',height+"px");


$('.form_date').datetimepicker({
	language:  'en',
	weekStart: 1,
	todayBtn:  1,
	autoclose: 1,
	todayHighlight: 1,
	startView: 2,
	minView: 2,
	forceParse: 0,
	format: "dd MM yyyy"
});


jQuery.validator.setDefaults({
    highlight: function(element) {
        jQuery(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function(element) {
        jQuery(element).closest('.form-group').removeClass('has-error');
    },
    errorElement: 'span',
    errorClass: 'label label-danger',
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }
});

$('#student_admission').validate();


