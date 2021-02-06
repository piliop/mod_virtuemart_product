<?php 

// no direct access
defined( '_JEXEC' ) or die('Restricted access');
vmJsApi::jPrice();

$document = JFactory::getDocument();

if ($layout=='slide'){
  $document->addScript(JUri::base().'templates/astroid_template_zero/html/mod_virtuemart_product/js/tiny-slider.js');
	$document->addStyleSheet(JUri::base().'templates/astroid_template_zero/html/mod_virtuemart_product/css/tiny-slider.css');
	$document->addStyleSheet(JUri::base().'templates/astroid_template_zero/html/mod_virtuemart_product/css/custom-tiny-slider.css');
}

?>
<?php // tiny slider https://github.com/ganlanyuan/tiny-slider ?>

<div class="vmgroup<?php echo $params->get( 'moduleclass_sfx' ) ?>">

	<?php if($headerText) { ?>
		<div class="vmheader"><?php echo $headerText ?></div>
	<?php } ?>

	<div class="product-container vmproduct<?php echo $params->get( 'moduleclass_sfx' ); ?> productdetails product_module">
		<div class="productslider<?php echo $module->id;?>">
			<?php foreach( $products as $product ) { ?>
			<?php if ($product->product_parent_id==0){ ?>
				<div class="product-container">
					<div class="spacer">
					<div class="vm-product-media-container">
						<?php
							if (!empty($product->images[0])) {
								list($width, $height, $type, $attr) = getimagesize( $product->images[0]->getFileUrlThumb());
									$image = $product->images[0]->displayMediaThumb('class="browseProductImage" ', false);
							} else {
									$image = '';
							}

							echo JHTML::_('link', JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$product->virtuemart_product_id.'&virtuemart_category_id='.$product->virtuemart_category_id), $image, array('title' => $product->product_name)); ?>

</div>
							<?php 
							
							if ($show_price) {
								echo '<div class="product-price my-3" style="text-align:center;float:none;">';
										if ((round((abs($product->prices['discountAmount']) / $product->prices['basePriceWithTax']) * 100))>0){
												echo '<div class="discountPercent"><span class="Pricediscountpercent"> - '. round((abs($product->prices['discountAmount']) / $product->prices['basePriceWithTax']) * 100).'%</span></div>';
										}
								echo '</div>';
							}?>
							
								<div class="name" style="text-align:center; margin-bottom:15px;">	
									<?php 
											echo JHTML::_('link', JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$product->virtuemart_product_id.'&virtuemart_category_id='.$product->virtuemart_category_id), $product->product_name); ?>								
									</div>
								<?php echo '<div class="clear"></div>'; ?>


							<?php

							if ($show_price) {

									if (round($product->prices['basePriceWithTax'],$currency->_priceConfig['salesPrice'][1]) != round($product->prices['salesPrice'],$currency->_priceConfig['salesPrice'][1])) {
										echo '<span class="price-crossed text-center text-muted" >' . $currency->createPriceDiv ('basePriceWithTax', 'COM_VIRTUEMART_PRODUCT_BASEPRICE_WITHTAX', $product->prices) . "</span>";
									} ?>

									<div class="text-center" style="font-size:1.4rem;">
										<strong>
											<?php echo $currency->createPriceDiv ('salesPrice', 'COM_VIRTUEMART_PRODUCT_SALESPRICE_WITH_DISCOUNT', $product->prices);?>
										</strong>
									</div>
									<?php
			
							} ?>

							<?php echo '<div class="clear"></div>'; ?>

							<?php if ($show_category==1){?>
								<div class="description">
									<a href="<?php echo $url; ?>">
									<?php if(empty($product->product_desc )){?>
										<?php echo JHtml::_('string.truncate', strip_tags($product->product_s_desc), $params->get('descrcharacters'));?>
									<?php } else {
											echo JHtml::_('string.truncate', strip_tags($product->product_desc), $params->get('descrcharacters'));
										}?>
									</a>
								</div>
							<?php } ?>

							<?php echo '<div class="clear"></div>'; ?>

							<div class="">
								<?php 
								if ($show_addtocart) {
										echo shopFunctionsF::renderVmSubLayout('addtocart', array('product' => $product));
								} ?>
							</div>
					</div>
			</div>

		<?php } ?>
		<?php } ?>
		</div>
		<?php if($footerText) { ?>
			<div class="vmheader"><?php echo $footerText ?></div>
		<?php } ?>
	</div>
</div>

<script>
  var slider = tns({
    container: '.productslider<?php echo $module->id;?>',
		items: <?php echo $max_items;?>,
		"loop": true,
		"autoplay": true,
		"autoplayTimeout": 5000,
		"mouseDrag": true,
		"gutter": 25,
		"swipeAngle": 15,
		"speed": 3000,
		"slideBy": '1',
		"controlsText": ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
		"nav":true,
		"center":false,
		"navPosition":'bottom',
		"rewind":false,
		"controls":true,
		"autoplayPosition":'top',
		"autoplayButtonOutput":false,
		"autoplayHoverPause":true,
    responsive: {
			250:{
				items:1
			},
			350:{
				items:2
			},
			576:{
				items:2
			},
      768: {
       items:2
      },
      992: {
				items: 3
      },
			1200: {
				items: 4
      }
    }

  });
</script>