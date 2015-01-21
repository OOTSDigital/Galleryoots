//JS handling gallery

//extra html that is added dynamically using jQuery
var $overlay = $('<div class="overlay"></div>');
var $overlay_container = $('<div class="overlay-container"></div>');
var $image = $("<img />");
var $close = $('<div class="close"><a href="#"> <i class="fa fa-times"></i> close </a></div>');
var $prev = $('<a href="#prev" class="prev"> <i class="fa fa-chevron-left"></i> </a>');
var $next = $('<a href="#" class="next"> <i class="fa fa-chevron-right"></i> </a>');
var $description = $('<div class="descriptionText"></div>');
//end extra html added by jQuery

//Append above divs to overlay
$overlay.append( $overlay_container.append($prev,$next,$close,$image,$description) );

//Append overlay to site-content
$(".site-content").append($overlay);

var $mediaGallery = $(".media-gallery");
var $gallery = $(".single-gallery");
var $linkToList = $("#linkToList");

//active galleries_no is defined in layout...
//setup multi-dimensional array of gallery image ids and links
var galleryArr2 = new Array(total_galleries);  //number 2 is the size of the gallery to display, should be setup in 

  for (i=0; i <galleryArr2.length; i++){
      galleryArr2[galleryActiveArray[i]] = []; //galleryActiveArray comes from _layout
  }

//end setup multi-dimensional array  

$gallery.find("a").each(function(){
    
    var imageLocation = $(this).attr("href");
    var imageId = $(this).find("img").attr("id");
    var gallery_name = $(this).parent().attr("id");
    var gallery_name2 = $(this).parent().attr("data-name");

    var overlay_id = gallery_name.split("_");

    //var gallery_id = parseInt(overlay_id[1])-1;
    var gallery_id = parseInt(overlay_id[1]);

    galleryArr2[gallery_id].push([{"id":imageId,"imageLocation":imageLocation,"gallery_name":gallery_name2}]); //to be used in displaying images in prev/next

});

//Capture the click event on a link to an image
$gallery.on('click', 'a', function(event){
  event.preventDefault();  //prevent default behavior
  var $this = $(this);
  var imageLocation = $this.attr("href");
  var gallery_name = $this.parent().attr("id");
  var gallery_name2 = $this.parent().attr("data-name");
  var imageId = $this.find("img").attr("id");
  var overlay_id = gallery_name.split("_");
  var gallery_id = parseInt(overlay_id[1]);

  var gallery_length = Object.keys(galleryArr2[gallery_id]).length;  //use Object.keys() to get the length of the array

  $image.attr({
    "src": imageLocation, 
    "id": imageId,
  });
  
  $description.text("image " + imageId + " of " + gallery_length); //attach text image n of 4
  //Show the overlay.
  $overlay.attr("id",gallery_name).fadeIn(250);
  //Get child's alt attribute and set caption
});

//when pressing prev link 
$(".prev").on('click', function(event){
  event.preventDefault(); //prevent default behavior

  var $this = $(this);
  var currentId = $this.parents("div.overlay").find("img").attr("id"); //id
  var overlay = $this.parents("div.overlay").attr("id"); //gallery_name
  var overlay_id = overlay.split("_");
  var gallery_id = parseInt(overlay_id[1]);

  var imageId = parseInt(currentId)-2; //why minus 2
  var gallery_length = galleryArr2[gallery_id].length;

  if(imageId >= 0){ 

    var imageLocation = galleryArr2[gallery_id ][imageId][0].imageLocation;
    var gallery_name = galleryArr2[gallery_id ][imageId][0].gallery_name;
    var image_id = galleryArr2[gallery_id ][imageId][0].id;

    $('.overlay').attr('data-name',gallery_name);
    
    $description.text("image " + image_id + " of " + gallery_length);

    $image.attr({
          "src": imageLocation, 
          "id": image_id
      });
  }
});

//when pressing next link 
$(".next").on('click', function(event){
    event.preventDefault(); //prevent default behavior

    var currentId = $(this).parents("div.overlay").find("img").attr("id"); //id
    var overlay = $(this).parents("div.overlay").attr("id"); //gallery_name
    var overlay_id = overlay.split("_");
    var gallery_id = parseInt(overlay_id[1]);

    var imageId = parseInt(currentId);
    var gallery_length = galleryArr2[gallery_id].length;

    if( currentId <= gallery_length){

      var imageLocation = galleryArr2[gallery_id][currentId][0].imageLocation;
      var gallery_name = galleryArr2[gallery_id][currentId][0].gallery_name;
      var image_id = galleryArr2[gallery_id][currentId][0].id;

      console.log($('.overlay'));

      $('.overlay').attr('data-name',gallery_name);

      $description.text("image " + image_id + " of " + gallery_length);

      $image.attr({
              "src": imageLocation, 
              "id": image_id
        });
    }
});

function addGalleryNav(title){
  $linkToList.append('<span><i class="fa fa-angle-right"></i>'+title+'</span>')
}

function removeGalleryNav(){
  $linkToList.find('span').remove();
}

//selecting which gallery to show
$mediaGallery.on('click', 'a', function(event) {
    event.preventDefault(); //prevent default behavior
    $mediaGallery.hide("slow");
    
    var gallery_id = $(this).parent().attr("id").split("_");

    var gallery_to_show = "#gallery"+"_"+gallery_id[1];

    var data_name = $(this).parent().attr("data-name");

    $('[data-name="'+ data_name +'"]').show("slow");

    addGalleryNav($(this).find('.gallery-name b').html());

 });

//link to view all galleries, hide if one gallery was shown, then show the galleryList
$linkToList.on('click', 'a', function(event){
     event.preventDefault(); //prevent default behavior
     $mediaGallery.show("slow");
     $gallery.hide("slow");
     removeGalleryNav();
});

//When close is clicked
$close.click(function(event){
  event.preventDefault(); //prevent default behavior
  //Hide the overlay
  $overlay.fadeOut(250);
});