<ul class="nav">
<?
?>
		<li>
			<a class="rann-razv<?=(Request::initial()->uri() == 'shop/rann-razv')?'-cur':''?>" href="/shop/rann-razv"></a>
		</li>
		<li>
			<a class="sam<?=(substr_count(Request::initial()->uri(), 'sdelay-sam'))?'-cur':''?>" href="/sdelay-sam"></a>
		</li>
		<li>
			<a class="vid<?=(substr_count(Request::initial()->uri(), 'video'))?'-cur':''?>" href="/video"></a>
		</li>
</ul>