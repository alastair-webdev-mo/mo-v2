
<form action="/" method="get" class="nav__searchform">
	<a class="nav__searchclose"><div class="close icon"></div></a>
    <input id="search" name="s" type="text" placeholder="Search the site..." class="input input--search" value="<?php the_search_query(); ?>" /> <button class="button button--searchicon"><i class="fa fa-lg fa-fw fa-search" aria-hidden="true"></i></button>
</form>