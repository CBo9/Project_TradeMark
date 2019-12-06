<?php 

$title = "Bienvenue sur le site";

ob_start() ?>
<div id="maincontent">
	
	<div id="siteHowTo">
		<h1>Bienvenue sur le site</h1>

			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam in magna nibh. Mauris at fermentum est. Nullam sodales odio urna, ut consequat massa volutpat non. Morbi sem ex, blandit at metus vitae, aliquam vestibulum lectus. Suspendisse at nisi lacus. Fusce ac luctus enim, non ultrices sem. In molestie libero eu tellus molestie pellentesque. Praesent tempor nisl vel tempus porta. Proin ullamcorper, dolor eget euismod rutrum, nibh arcu eleifend risus, sed bibendum justo erat nec tellus. In volutpat aliquam lorem, ac pulvinar risus accumsan non. Nullam eu ultricies justo. Pellentesque tincidunt quam turpis, et interdum metus volutpat ut. Curabitur vel ligula augue. Donec maximus lacus non sapien molestie, a tincidunt erat efficitur. Duis purus quam, dictum eget sodales et, lacinia vitae orci. Maecenas eget iaculis nisi, et auctor augue.</p>

			<p>Aliquam sapien dui, ultricies at gravida nec, condimentum vel tortor. Duis blandit massa ut lectus ultricies, at venenatis lorem ornare. Suspendisse feugiat erat velit, sit amet venenatis mi pharetra ac. Morbi varius ante ante. Morbi at feugiat diam. Quisque blandit tristique porta. Mauris scelerisque pharetra congue. Suspendisse sed imperdiet ipsum. Integer cursus metus ut lectus tincidunt, non imperdiet lectus venenatis. Aenean fringilla venenatis scelerisque. Proin tincidunt diam vel tortor sagittis suscipit. Mauris elementum nunc a maximus bibendum. Vivamus sed enim id quam lobortis suscipit. Ut non efficitur magna. Mauris interdum libero vel orci volutpat lacinia.</p>

			<p>Aliquam erat volutpat. Morbi pellentesque augue a nisi viverra, eu tristique tortor condimentum. Donec sed suscipit nulla. Integer vel pharetra enim. Donec bibendum mi nec eros lacinia tincidunt. Nunc at faucibus odio, ac tincidunt orci. In dolor nulla, facilisis in mi vitae, efficitur ornare mauris. Mauris eu lorem in erat pretium aliquam. Vivamus id laoreet lectus, non rhoncus ipsum. Donec rutrum luctus efficitur. In facilisis libero id libero luctus, tincidunt elementum libero tincidunt. Nulla sed ipsum lectus. Vestibulum ac turpis convallis, vestibulum odio dignissim, ullamcorper mauris. Praesent sem ligula, vestibulum eu nibh vitae, efficitur luctus mi. Suspendisse non mauris vitae nulla lacinia ultricies at non justo. Nullam et tortor sit amet tortor porttitor rutrum.</p>

			<p>Suspendisse convallis lobortis justo vel pellentesque. Nunc id libero aliquet, tincidunt tellus id, aliquet lorem. Suspendisse eros ipsum, varius et eros ut, volutpat fringilla sapien. Nullam finibus sapien eget ultrices scelerisque. Proin non dapibus metus, eu auctor ipsum. Nullam ligula dolor, porta quis pulvinar eu, consectetur non purus. Mauris eget velit vitae nisl venenatis consectetur quis eu justo. Suspendisse rutrum dolor id accumsan dignissim.</p>

			<p>Integer aliquam quam et pretium porttitor. Aliquam quis diam viverra, lacinia turpis in, auctor mi. Aliquam erat volutpat. Pellentesque in faucibus risus, quis commodo nisi. Curabitur lectus erat, facilisis ac nisi eu, lacinia commodo nibh. Vivamus varius velit nec mattis suscipit. Fusce libero quam, cursus vel odio eu, mattis porttitor lectus. Pellentesque faucibus nisi augue, a lacinia diam feugiat at. Proin molestie bibendum elit, ut sollicitudin purus dignissim id. Vivamus ipsum ipsum, ultrices at condimentum id, lobortis euismod elit. Vestibulum efficitur sit amet turpis eget vestibulum. Suspendisse accumsan mi vel velit dictum convallis.</p>

			<p>Morbi eget tincidunt risus, id dignissim est. Fusce lacus leo, eleifend eu rutrum quis, consectetur sed purus. In consectetur arcu et pulvinar dapibus. Duis feugiat purus a ante hendrerit, vel venenatis purus placerat. Pellentesque in odio sodales, hendrerit magna vel, vehicula dolor. Sed ullamcorper laoreet convallis. Vestibulum faucibus ornare vestibulum. Morbi eget tincidunt nibh. Aenean eget libero ac diam iaculis finibus. Curabitur vitae condimentum nisi. Cras in velit elit. Aliquam erat volutpat. Nam sed maximus urna, id pellentesque libero. Nulla porta augue eu elit sagittis vulputate.</p>

			<p>Nam at urna non dui imperdiet laoreet. Maecenas hendrerit tellus ac tortor aliquam congue. Proin vel faucibus augue. Nunc tempor nunc in sollicitudin molestie. Integer lobortis, urna vitae dignissim fringilla, lectus leo aliquet lorem, ac dapibus felis lorem nec velit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at pharetra ligula. Maecenas ac turpis sapien. Fusce quis scelerisque nunc. Donec sed lacus sit amet arcu ultrices convallis. Proin dapibus dapibus elit, eu molestie mauris aliquet sed. Phasellus vestibulum neque sit amet nisl mattis, eu volutpat lorem fermentum. Proin leo sapien, pulvinar posuere dui id, tempor scelerisque mauris. Sed vel purus erat. </p>
	</div>

	<div id="lastItemsAdded">
		<h2>Derniers articles ajoutés</h2>
		<?php foreach ($lastItems as $item) :?>
			<div class='lastItem'>
				<img class="itemSmallPic" src="public/img/items/<?= $item->getPicture();?>">
				<h3><?= $item->getName();?></h3>
				<span>Mis en ligne par 
					<a href="index.php?a=profile&amp;id=<?= $item->getOwnerId();?>">
						<?= $item->getOwnerNickname();?>
					</a>
				</span>
			</div>
		<?php endforeach;?>
	</div>

</div>
<?php $content = ob_get_clean();

require_once 'view/mainTemplate.php';