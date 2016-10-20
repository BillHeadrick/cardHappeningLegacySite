<script type="text/javascript">
	
	var productImages = [];
	
	/*
	 * productImages->style
	 * productImages->style_id
	 * productImages->src
	 * productImages->alt
	 */
	
	
	$(function(){ <?php //load product images object ?>
		$.post('ajax/loadProductImagesAJAX.php', function(data){
			var image = data.split('<987&789*#$2');
			var len = image.length + productImages.length;
			var i = productImages.length;
			var w = 1;
			while(i+1 < len){
				var current = image[w];
				current = String(current);
				current = current.split(',');
				productImages[i] = {
					style:current[0],
					style_id:current[1],
					src:current[2],
					alt:current[3],
					order:current[4],
					status:1
				}
				i++;
				w++;
			}
			displayImages(); <?php //this function will be loaded depending on the page, every page will have productImages object, but the way it is implemented will be differently ?>
			$('.productImages').hide();
			$('#productImagesCol1').cycle();
			$('#productImagesCol2').cycle();
			$('#productImagesCol3').cycle();
		});
	})
	
	
	function displayImages(){
		var len = productImages.length;
		var i = 0;
		while(i < len){
			if(productImages[i].status === 1){
				var append = makeImage(i);
				switch(productImages[i].order){
					case '1':
						$('#productImagesCol1').append(append);
						break;
					case '2': 
						$('#productImagesCol2').append(append);
						break;
					case '3':
						$('#productImagesCol3').append(append);
						break;	
				}
			}
			i++;
		}
	}
	
	function makeImage(id){
		if(productImages[id].status === 1){
			var image = "<a class='productImages"+productImages[id].style_id+"240 productImages' href='"+productImages[id].src+"' target='_blank'><img src='"+productImages[id].src+"' class='confined img-rounded' alt='"+productImages[id].alt+"'></a>";
			//console.log(image);
			return image;
		}
	}
</script>
