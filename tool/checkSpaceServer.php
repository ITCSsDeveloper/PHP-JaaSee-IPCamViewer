	<?php
	$df = disk_free_space("d:/");
	$dt = disk_total_space("d:/");
	$du = $dt - $df;
	$dp = sprintf('%.2f',($du / $dt) * 100);
	$df = formatSize($df);
	$du = formatSize($du);
	$dt = formatSize($dt);

	function formatSize( $bytes )
	{
		$types = array( 'B', 'KB', 'MB', 'GB', 'TB' );
		for( $i = 0; $bytes >= 1024 && $i < ( count( $types ) -1 ); $bytes /= 1024, $i++ );
			return( round( $bytes, 2 ) . " " . $types[$i] );
	}
	?>
	<div class='progress'>
		<div class='prgtext'><?php echo $dp; ?>% Disk Used</div>
		<div class='prgbar'></div>
		<div class='prginfo'>
			<span style='float: left;'><?php echo "$du of $dt used"; ?></span>
			<span style='float: right;'><?php echo "$df of $dt free"; ?></span>
			<span style='clear: both;'></span>
		</div>
	</div>