

$(document).ready(function(){
    $(document).on('click','.choose-image', function(){
        $('.img-thumbnail').trigger('click');
    });
	$(document).on('click','.img-thumbnail', function(){
		BrowseServerPreview($(this));
	});
    $(document).on('click','.img_version_select', function(){
        let id = $(this).attr('data-target')
        BrowseServerProduct($(this), id);
    });
    $(document).on('click','.va-img-click', function(){
        BrowseServerInput($(this));
    });
	$(document).on('click','.uploadMultiImage', function(){
        let target = $(this).attr('data-target');
		BrowseServerEditor('Images', target);
        return false;
	});
    $(document).on('click','.uploadImage', function(){
        BrowseServerImage($(this));
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

function BrowseServerImage  (object, type){
    if(typeof(type) == 'undefined'){
        type = 'Images';
    }
    var finder = new CKFinder();
    finder.resourceType = type;
    finder.selectActionFunction = function( fileUrl, data ) {
        fileUrl =  fileUrl.replace(BASE_URL, "/");
        path = object.parent().siblings('.ibox-content')
        path.find('img').attr('src', fileUrl);
        path.find('input').val(fileUrl);
    }
    finder.popup();
}


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


function BrowseServerInput  (object, type){
    if(typeof(type) == 'undefined'){
        type = 'Images';
    }
    var finder = new CKFinder();
    finder.resourceType = type;

    finder.selectActionFunction = function( fileUrl, data ) {
        console.log(fileUrl)
        fileUrl =  fileUrl.replace(BASE_URL, "/");

        object.val(fileUrl)
    }
    finder.popup();
}

function BrowseServerAlbum(object,name,count, type){
    var finder = new CKFinder();
    finder.resourceType = type;

    finder.selectActionFunction = function(fileUrl , data, allFiles ) {
        if(typeof(type) == 'undefined'){
            type = 'Images';
        }

        if(typeof(name) == 'undefined'){
            name = 'album';
        }else{
            name = name+'['+count+']';
        }
        

        var files = allFiles;
        var li = '';
        for(var i = 0 ; i < files.length; i++){
            fileUrl =  files[i].url.replace(BASE_URL, "/");
            li = li + '<li class="ui-state-default">';
                li = li + '<div class="thumb">';
                    li = li + '<span class="image img-scaledown">';
                        li = li + '<img src="'+fileUrl+'" alt="">'; 
                        li = li + '<input type="hidden" value="'+fileUrl+'" name="'+name+'[]">';
                    li = li + '</span>';
                    li = li + '<div class="overlay"></div><div class="delete-image"><i class="fa fa-trash" aria-hidden="true"></i></div>';
                li = li + '</div>';
            li = li + '</li>';
        }
        $('.click-to-upload').hide();
        $('.upload-list').show();
        object.parents('.album').find('.data-album').append(li);

    }
    finder.popup();
}

function BrowseServerAlbum1(object, type){
    var finder = new CKFinder();
    finder.resourceType = type;

    finder.selectActionFunction = function(fileUrl , data, allFiles ) {
        if(typeof(type) == 'undefined'){
            type = 'Images';
        }
        var files = allFiles;
        for(var i = 0 ; i < files.length; i++){
            fileUrl =  files[i].url.replace(BASE_URL, "/");
        }
        var formURL = 'ajax/slide/echoview';
                    $.post(formURL, {
                        file: fileUrl, count: count},
                        function(data){
                            let json = JSON.parse(data);;
                            $('#sortable').append(json.html);
                                
                        });
        
        $('.click-to-upload').hide();
        $('.upload-list').show();
    }
    finder.popup();
}

function BrowseServerAlbumModal(object, id , type){
    var finder = new CKFinder();
    finder.resourceType = type;
    finder.selectActionFunction = function(fileUrl , data, allFiles ) {
        if(typeof(type) == 'undefined'){
            type = 'Images';
        }
        
        let data_id = object.attr('data-id')
        var files = allFiles;
        var li = '';
        let album  = [];
        for(var i = 0 ; i < files.length; i++){
            fileUrl =  files[i].url.replace(BASE_URL, "/");
            album.push(fileUrl);
            if( i == 0){
                console.log(1)
                $(data_id).find('img').attr('src', fileUrl)
            }
            li = li + '<li class="ui-state-default">';
                li = li + '<div class="thumb">';
                    li = li + '<span class="image img-scaledown img-model">';
                        li = li + '<img src="'+fileUrl+'" alt="">'; 
                    li = li + '</span>';
                    li = li + '<div class="overlay"></div><div class="delete-image del_img_modal" data-id="#'+id+'"><i class="fa fa-trash" aria-hidden="true"></i></div>';
                li = li + '</div>';
            li = li + '</li>';
        }

        var myJSON = JSON.stringify(album);
        object.parents('.modal').find('.sort-modal').append(li);
        object.parents('.modal').find('.click-to-upload').hide();
        object.parents('.modal').find('.upload-list').show();
        let val = $(data_id).find('.input_img_version').val();
        let value  = "";
        if(val != undefined){
            let value = value_handling(val)
        }
        console.log(value)

        if(value != ''){
            myJSON = myJSON.split('[')
        }
        $(data_id).find('.input_img_version').val(value +((value == "") ? '' : ',')+ ((value == "") ? myJSON : myJSON[1]));
    }
    finder.popup();
}

function value_handling(value){
    let end = value.split("]");
    let result = end[0];
    return result;
}

function BrowseServerProduct(object,id , type){
    var finder = new CKFinder();
    finder.resourceType = type;

    finder.selectActionFunction = function(fileUrl , data, allFiles ) {
        if(typeof(type) == 'undefined'){
            type = 'Images';
        }
        
        var li = '';
        var files = allFiles;
        let album  = [];
        for(var i = 0 ; i < files.length; i++){
            fileUrl =  files[i].url.replace(BASE_URL, "/");
            album.push(fileUrl);
            if(i == 0){
                object.attr('src', fileUrl);
            }
        }
        var myJSON = JSON.stringify(album);
        let val = object.parents('tr').find('.input_img_version').val();
        let value  = "";
        if(val != undefined){
            let value = value_handling(val)
        }
        if(value != ''){
            myJSON = myJSON.split('[')
        }
        object.parents('tr').find('.input_img_version').val(value + ((value == "") ? '' : ',')+ ((value == "") ? myJSON : myJSON[1]));
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