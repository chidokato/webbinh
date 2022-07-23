@extends('layout.index')



@section('content')
<header class="l-section c-page-header c-page-header--header-type-1 c-page-header--default
 c-page-header--wc c-page-header--low">

					<div class="c-page-header__wrap">
									<h1 class="c-page-header__title">Wishlist</h1>
							</div>
		
				<nav class="c-breadcrumbs">
		<ol class="c-breadcrumbs__list c-breadcrumbs__list--default" itemscope="" itemtype="http://schema.org/BreadcrumbList">
							<li class="c-breadcrumbs__item  c-breadcrumbs__item--first  " itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
					<a itemprop="item" title="Home" href="../index.html"><span itemprop="name">Home</span></a><!--
						--><i class="ip-breadcrumb c-breadcrumbs__separator"><!-- --></i>					<meta itemprop="position" content="1">
				</li>
								<li class="c-breadcrumbs__item   c-breadcrumbs__item--last " itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
					<a itemprop="item" title="Wishlist" href="index.html"><span itemprop="name">Wishlist</span></a>					<meta itemprop="position" content="2">
				</li>
						</ol>
	</nav>	</header>
	<div class="woocommerce-notices-wrapper woocommerce-notices-wrapper--ajax woocommerce-notices-wrapper--transition" style="top: 15px; transform: translateY(0px);"></div>
	<div class="l-section l-section--container l-section--bottom-margin l-section--no-sidebar l-section--top-margin-60 l-section--bottom-margin--60 l-section--white">
			<div class="l-section__content">
									
	<div class="c-cart-empty js-wishlist-empty ">
		<div class="c-cart-empty__image-wrap">
							<i class="ip-wishlist-empty c-cart-empty__icon c-cart-empty__icon--failed"></i>
					</div>
		<h1 class="c-cart-empty__header">Your wishlist is currently empty</h1>
		<p class="c-cart-empty__note">Click the <i class="ip-wishlist c-cart-empty__wishlist"></i> icons to add products</p>
					<a class="c-button c-button--outline c-cart-empty__backward" href="../shop/index.html">
				Return to shop			</a>
			</div>
								</div>
					</div>
@endsection