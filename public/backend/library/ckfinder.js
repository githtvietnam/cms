

$(document).ready(function(){
    $(document).on('click','.choose-image', function(){
        $('.img-thumbnail').trigger('click');
    });
	$(document).on('click','.img-thumbnail', function(){
		BrowseServerPreview($(this));
	});
	$(document).on('click','.uploadMultiImage', function(){
        let target = $(this).attr('data-target');
		BrowseServerEditor('Images', target);
        return false;
	});
  $(document).on('click','.tv-nav-tabs>li>a ', function(){
        let _this = $(this);
        let parent = _this.closest('li.tv-block');
        let target = _this.attr('href');
        parent.find('.tab-pane').removeClass('active');
        parent.find(target).addClass('active');

        return false;
  });
  
});


function BrowseServerEditor(type, field){
    var finder = new CKFinder();
    var object  = editors[field] // Xac dinh editor ma minh muon cho anh vao
    finder.resourceType = type;
    finder.selectActionData = field;

    finder.selectActionFunction = function(fileUrl , data, allFiles ) {
  	 	var files = allFiles;
        var content = '';
        for(var i = 0 ; i < files.length; i++){
            fileUrl =  files[i].url.replace(BASE_URL, "/");
            content = content + '<img src="'+fileUrl+'" alt="'+fileUrl+'">';
        } 
        const viewFragment = object.data.processor.toView( content );
        const modelFragment = object.data.toModel( viewFragment );
        object.model.insertContent( modelFragment);
    }
    finder.popup();
}


function BrowseServerAlbum(object, type){

    if(typeof(type) == 'undefined'){
        type = 'Images';
    }
    var finder = new CKFinder();
    finder.resourceType = type;

    finder.selectActionFunction = function(fileUrl , data, allFiles ) {
        var files = allFiles;
        var li = '';

        // let leng = k + files.length;
        // console.log(leng);

       
        for(var i= 0 ; i < files.length; i++)
        {
            fileUrl =  files[i].url.replace(BASE_URL, "/");
           
            li=li+ '<li class="tv-block ui-state-default">';
              li=li+  '<div class="tv-slide-container">';
                  li=li+   '<div class="col-sm-3">';
                      li=li+  '<div class="thumb tv">';
                        li=li+  '<span class="image img-cover">';
                          li=li+    '<img src="'+fileUrl+'" alt="" /> <input type="hidden" value="'+fileUrl+'" name="album['+k+'][image]" />';
                            li=li+  '</span>';
                            li=li+  '<div class="overlay"></div>';
                            li=li+   '<div class="delete-image"><i class="fa fa-trash" aria-hidden="true"></i></div>';
                            li=li+   '<div class="tv number"><input name="album['+k+'][number]"" value= "0" type="text"  class=" tv-input"></div>';
                           
                          li=li+ '</div>';
                         
                        li=li+  '</div>';

                    li=li+  '<div class="col-lg-9">';
                        li=li+ '<div class="tabs-container tv">';
                            li=li+ '<ul class="nav nav-tabs tv-nav-tabs">';
                                li=li+ '<li class=" tab-0 tab-pane active"><a href=".tab-0" aria-expanded="true"> Thông tin chung</a></li>';
                                li=li+ '<li class="tab-1 tab-pane"><a href=".tab-1" aria-expanded="false">SEO</a></li>';
                            li=li+ '</ul>';
                            li=li+ '<div class="tab-content">';
                                li=li+ '<div  class="tab-0 tab-pane active">';
                                   li=li+  '<div class="panel-body">';
                                    li=li+ '<div class="row mb5">';
                                          li=li+   '<input  placeholder="Tiêu đề Slide" type="text" name="album['+k+'][title]"  class="form-control m-b">';
                                          li=li+ '</div>';
                                          li=li+ '<div class="row ">';
                                          li=li+   '<textarea  placeholder="Mô tả Slide" name="album['+k+'][description]"  class="form-control m-b"></textarea>';
                                          li=li+ '</div>'; 
                                    li=li+ '</div>';
                                li=li+ '</div>';
                                li=li+ '<div  class="tab-1 tab-pane">';
                                  li=li+'<div class="panel-body">';
                                       
                                           
                                            li=li+ '<div class="row mb5">';
                                              
                                                li=li+     '<div class="form-row">';
                                                    
                                                      li=li+   '<input  placeholder="Tiêu đề SEO" name="album['+k+'][meta_title]" type="text"  class="form-control m-b">';
                                                   li=li+  '</div>';
                                               
                                           li=li+  '</div>';
                                            li=li+ '<div class="row mb18">';
                                             
                                               li=li+      '<div class="form-row">';
                                                       
                                                        li=li+ '<textarea  placeholder="Mô tả SEO" name="album['+k+'][meta_description]"  class="form-control m-b"></textarea>';
                                                    li=li+ '</div>';
                                                
                                            li=li+ '</div>';
                                            
                                      
                                                                                               
                                   li=li+  '</div>';
                                li=li+ '</div>';
                          li=li+  '</div>';
                        li=li+ '</div>';
                    li=li+ '</div>';
                li=li+ '</div>';
            li=li+ '</li>';
            
            k += 1;
            

        }

        console.log(k);
        $('#sortable').append(li);
        $('.click-to-upload').hide();
        $('.upload-list').show();

    }
    finder.popup();

}




function BrowseServerPreview  (object, type){
	if(typeof(type) == 'undefined'){
		type = 'Images';
	}
	var finder = new CKFinder();
	finder.resourceType = type;
	 finder.selectActionFunction = function( fileUrl, data ) {
        fileUrl =  fileUrl.replace(BASE_URL, "/");
        object.attr('src', fileUrl);
        object.parent().siblings('input').val(fileUrl)
    }
    finder.popup();
}

function BrowseServer (object, type){
	if(typeof(type) == 'undefined'){
		type = 'Images';
	}
	var finder = new CKFinder();
	finder.resourceType = type;
	 finder.selectActionFunction = function( fileUrl, data ) {
        fileUrl =  fileUrl.replace(BASE_URL, "/");
        object.setAttribute('value', fileUrl);
    }
    finder.popup();
}


const editors = {};
function ckeditor5(elementId){
    return  ClassicEditor
        .create( document.getElementById( elementId ), {
            image: {
                resizeUnit: 'px',
                styles: [
                    'alignLeft', 'alignCenter', 'alignRight'
                ],
                toolbar: [
                    'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight',
                    '|',
                    'imageResize',
                    '|',
                    'imageTextAlternative'
                ]
            },
            toolbar: {
                items: [
                    'heading','|','bold','italic','link','bulletedList','numberedList','|','indent','outdent','|','imageUpload','blockQuote','insertTable','mediaEmbed','undo','redo','fontBackgroundColor','codeBlock','code','fontColor','fontSize','fontFamily','highlight','pageBreak','todoList','underline','alignment','horizontalLine'
                ]
            },
        } )
        .then( editor => {
            editors[ elementId ] = editor;
        })
        .catch( error => {
            console.error( 'Oops, something went wrong!' );
            console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
            console.warn( 'Build id: wxciefr33ukx-y6mvs3tvmy81' );
            console.error( error );
        });
}