<?php 
/**
 * Dimox Breadcrumbs
 * http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
 * Since ver 1.0
 * Add this to any template file by calling dimox_breadcrumbs()
 * Changes: MC added taxonomy support
 */
function mos_breadcrumbs(){
    $html = '';
  /* === OPTIONS === */
	$text['home']     = '<i class="fa fa-home"></i> Home'; // text for the 'Home' link
	$text['blog']	  = 'Blog';
	$text['category'] = 'Archive by Category "%s"'; // text for a category page
	$text['tax'] 	  = 'Archive for "%s"'; // text for a taxonomy page
	$text['search']   = 'Search Results for "%s" Query'; // text for a search results page
	$text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
	$text['author']   = 'Articles Posted by %s'; // text for an author page
	$text['404']      = 'Error 404'; // text for the 404 page
	$text['attachment'] = 'Attachment';
	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$showOnHome  = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter   = ''; // delimiter between crumbs
	//$before      = '<span class="current">'; // tag before the current crumb
	//$after       = '</span>'; // tag after the current crumb	
	$before      = '<li class="breadcrumb-item active">'; // tag before the current crumb
	$after       = '</li>'; // tag after the current crumb
	/* === END OF OPTIONS === */
	global $post;
	$homeLink = get_bloginfo('url') . '/';
	$linkBefore = '<li class="breadcrumb-item">';
	$linkAfter = '</li>';
	$linkAttr = ' rel="v:url" property="v:title"';
	$link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
	//$link = '';
	
	if (is_home()) {
		if ($showOnHome == 1) $html .= '<nav aria-label="breadcrumb"><ol class="breadcrumb">'.$linkBefore.'<a href="' . $homeLink . '">' . $text['home'] . '</a>'.$linkAfter.$before.$text['blog'].$after.'</ol>';
	} else {
		$html .= '<nav aria-label="breadcrumb"><ol class="breadcrumb">' . sprintf($link, $homeLink, $text['home']) . $delimiter;
		
		if ( is_category() ) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) {
				$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				$html .= $cats;
			}
			$html .= $before . sprintf($text['category'], single_cat_title('', false)) . $after;
		} 
        elseif( is_tax() ){
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) {
				$cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				$html .= $cats;
			}
			$html .= $before . sprintf($text['tax'], single_cat_title('', false)) . $after;
		
		} 
        elseif ( is_search() ) {
			$html .= $before . sprintf($text['search'], get_search_query()) . $after;
		} 
        elseif ( is_day() ) {
			$html .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			$html .= sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
			$html .= $before . get_the_time('d') . $after;
		} 
        elseif ( is_month() ) {
			$html .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			$html .= $before . get_the_time('F') . $after;
		} 
        elseif ( is_year() ) {
			$html .= $before . get_the_time('Y') . $after;
		} 
        elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				//printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
				if ($showCurrent == 1) $html .= $delimiter . $before . get_the_title() . $after;
			}
            else {
				// $cat = get_the_category(); $cat = $cat[0];
				// $cats = get_category_parents($cat, TRUE, $delimiter);
				// if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				// $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				// $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				// $html .= $cats;
				$page_for_posts = get_option( 'page_for_posts' );
				$html .= '<li class="breadcrumb-item"><a href="'.get_the_permalink( $page_for_posts ).'">' . get_the_title( $page_for_posts ) . '</a></li>';
				if ($showCurrent == 1) $html .= $before . get_the_title() . $after;
			}
		}
        elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			$html .= $before . $post_type->labels->singular_name . $after;
		}
        elseif ( is_attachment() ) {
			/* $parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, $delimiter);
			$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
			$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
			$html .= $cats;
			printf($link, get_permalink($parent), $parent->post_title);
			if ($showCurrent == 1) $html .= $delimiter . $before . get_the_title() . $after; */
			$html .= $before . $text['attachment'] . $after;
		} 
        elseif ( is_page() && !$post->post_parent ) {
			if ($showCurrent == 1) $html .= $before . get_the_title() . $after;
		} 
        elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				$html .= $breadcrumbs[$i];
				if ($i != count($breadcrumbs)-1) $html .= $delimiter;
			}
			if ($showCurrent == 1) $html .= $delimiter . $before . get_the_title() . $after;
		} 
        elseif ( is_tag() ) {
			$html .= $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
		} 
        elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata($author);
			$html .= $before . sprintf($text['author'], $userdata->display_name) . $after;
		} 
        elseif ( is_404() ) {
			$html .= $before . $text['404'] . $after;
		}
		if ( get_query_var('paged') ) {
			$html .= '<li class="breadcrumb-item">';
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $html .= ' (';
			$html .= __('Page') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $html .= ')';
			$html .= '</li>';
		}
		$html .= '</ol>';
	}
    //var_dump($html);
	return $html;
} // end mos_breadcrumbs()
add_shortcode( 'mos-breadcrumbs', 'mos_breadcrumbs' );