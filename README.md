<b>This is a craft CMS Image Gallery plugin.</b>

This Craft CMS Image Gallery plugin allows you to create as many galleries as you want.

How to use the plugin?

1. Upload the Craft CMS Image Gallery folder (galleryoots folder) to your craft/plugins/ folder

2. Go to settings —> Plugins from your Craft Control Panel and enable Galleryoots plugin

3. Click on Gallery OOTS tab to add New Gallery (Gallery Name, Assets Folder, Total Images, Status - Active or Inactive)

4. Select newly created Craft CMS Image Gallery by clicking edit and add images

5. Add Reference to jQuery (You need jQuery for the galleryoots.js to work)
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

6. To Display Craft CMS Image Gallery on a page add Gallery layout like media_gallery.html to your page layout

7. Add reference to galleryoots javascript in your _layout.html

```
<script>
     var total_galleries = {{craft.galleryoots.getActiveGalleriesNo}}; //number of active galleries in galleryoots plugin

     var galleryActiveArray = [];

     {% for gallery in craft.galleryoots.getActiveGalleriesArray %}

      galleryActiveArray.push({{gallery}});

     {% endfor %}

</script>

<script type="text/javascript" src="{{siteUrl}}path/to/your/galleryoots.js"></script>
```
To see a live example please visit http://www.snowymountains.com.au/media-gallery

This is Version 1.0
