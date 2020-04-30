$(document).ready(function() {
	$( ".karim-upload" ).change(readImage);

    $( ".preview-images-zone" ).sortable();

    $(document).on('click', '.image-cancel', function() {
        let no = $(this).data('no');
        $(".preview-image.preview-show-"+no).remove();
    });
    $("#preview-images-zone").on('click', function(e) {
		// if(e.target.id == "preview-images-zone") {
		// 	$('#pro-image').click();
		// }
    });
    $("#preview-images-zone .preview-image").on('click', function(e) {
		if($(e.target).is("img")) {
			$(this).children(".karim-upload").click();
		}
    });
});



var num = 4;
function readImage() {
    if (window.File && window.FileList && window.FileReader) {
        var files = event.target.files; //FileList object
        var output = $(".preview-images-zone");

        for (let i = 0; i < files.length; i++) {
            var file = files[i];
            if (!file.type.match('image')) continue;
            
            var picReader = new FileReader();
            
            picReader.addEventListener('load', function (event) {
                var picFile = event.target;
                var html =  '<div class="preview-image preview-show-' + num + '">' +
                            '<div class="image-cancel" data-no="' + num + '">x</div>' +
                            '<div class="image-zone"><img id="pro-img-' + num + '" src="' + picFile.result + '"></div>' +
							'<input style ="display: none" value="'+picFile.result+'"  type="file" class= " btn btn-default" name="image[]"size="20" multiple="multiple"/>'
                            '</div>';

                output.append(html);
                console.log(picFile)
                num = num + 1;
            });

            picReader.readAsDataURL(file);
        }
        // $("#pro-image").val('');
        console.log(JSON.stringify(event.target.files));
    } else {
        console.log('Browser not support');
    }
}

