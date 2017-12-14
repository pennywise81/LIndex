<?php

/*
Generic to create custom post types

https://codex.wordpress.org/Function_Reference/register_post_type
*/

function custom_post_type() {
  $labels = array(

    /*
    general name for the post type, usually plural. The same and overridden by
    $post_type_object->label. Default is Posts/Pages
    */
    'name' => 'Hersteller',

    /*
    name for one object of this post type. Default is Post/Page
    */
    'singular_name' => 'Hersteller',

    /*
    the add new text. The default is "Add New" for both hierarchical and
    non-hierarchical post types. When internationalizing this string, please use
    a gettext context matching your post type.
    Example: _x('Add New', 'product');
    */
    'add_new' => 'Neu hinzufügen',

    /*
    Default is Add New Post/Add New Page.
    */
    'add_new_item' => 'Neuen Hersteller anlegen',

    /*
    Default is Edit Post/Edit Page.
    */
    'edit_item' => 'Hersteller bearbeiten',

    /*
    Default is New Post/New Page.
    */
    'new_item' => 'Neuer Hersteller',

    /*
    Default is View Post/View Page.
    */
    'view_item' => 'Hersteller ansehen',

    /*
    Label for viewing post type archives. Default is
    'View Posts' / 'View Pages'.
    */
    'view_items' => 'Hersteller ansehen',

    /*
    Default is Search Posts/Search Pages.
    */
    'search_items' => 'Hersteller suchen',

    /*
    Default is No posts found/No pages found.
    */
    'not_found' => 'Kein Hersteller gefunden',

    /*
    Default is No posts found in Trash/No pages found in Trash.
    */
    'not_found_in_trash' => 'Kein Hersteller im Papierkorb gefunden',

    /*
    This string isn't used on non-hierarchical types. In hierarchical ones the
    default is 'Parent Page:'.
    */
    'parent_item_colon' => 'Übergeordneter Hersteller',

    /*
    String for the submenu. Default is All Posts/All Pages.
    */
    'all_items' => 'Alle Hersteller',

    /*
    String for use with archives in nav menus. Default is
    Post Archives/Page Archives.
    */
    'archives' => 'Herstellerarchiv',

    /*
    Label for the attributes meta box. Default is
    'Post Attributes' / 'Page Attributes'.
    */
    'attributes' => 'Herstellereigenschaften',

    /*
    String for the media frame button. Default is
    Insert into post/Insert into page.
    */
    'insert_into_item' => '',

    /*
    String for the media frame filter. Default is
    Uploaded to this post/Uploaded to this page.
    */
    'uploaded_to_this_item' => 'Diesem Hersteller zugewiesen',

    /*
    Default is Featured Image.
    */
    'featured_image' => 'Herstellerlogo',

    /*
    Default is Set featured image.
    */
    'set_featured_image' => 'Herstellerlogo festlegen',

    /*
    Default is Remove featured image.
    */
    'remove_featured_image' => 'Herstellerlogo entfernen',

    /*
    Default is Use as featured image.
    */
    'use_featured_image' => 'Als Herstellerlogo verwenden',

    /*
    Default is the same as `name`.
    */
    'menu_name' => 'Hersteller',

    /*
    String for the table views hidden heading.
    */
    // 'filter_items_list' => '',

    /*
    String for the table pagination hidden heading.
    */
    // 'items_list_navigation' => '',

    /*
    String for the table hidden heading.
    */
    // 'items_list' => '',

    /*
    String for use in New in Admin menu bar. Default is the same as
    `singular_name`.
    */
    // 'name_admin_bar' => '',

  );

  $args = array(
    /*
    (string) (optional) A plural descriptive name for the post type marked for translation.
    Default: Value of $labels['name']
    */
    'label' => $labels['name'],

    /*
    (array) (optional) labels - An array of labels for this post type. By
    default, post labels are used for non-hierarchical post types and page
    labels for hierarchical ones.

    Default: if empty, 'name' is set to value of 'label', and 'singular_name'
    is set to value of 'name'.
    */
    'labels' => $labels,

    /*
    (string) (optional) A short descriptive summary of what the post type is.
    Default: blank

    The only way to read that field is using this code:

    $obj = get_post_type_object( 'your_post_type_name' );
    echo esc_html( $obj->description );
    */
    'description' => '',

    /*
    (boolean) (optional) Controls how the type is visible to authors
    (show_in_nav_menus, show_ui) and readers
    (exclude_from_search, publicly_queryable).

    Default: false

    'true' - Implies exclude_from_search: false, publicly_queryable: true,
    show_in_nav_menus: true, and show_ui:true. The built-in types attachment,
    page, and post are similar to this.

    'false' - Implies exclude_from_search: true, publicly_queryable: false,
    show_in_nav_menus: false, and show_ui: false. The built-in types
    nav_menu_item and revision are similar to this. Best used if you'll provide
    your own editing and viewing interfaces (or none at all).

    If no value is specified for exclude_from_search, publicly_queryable,
    show_in_nav_menus, or show_ui, they inherit their values from public.
    */
    'public' => false,

    /*
    (boolean) (importance) Whether to exclude posts with this post type from
    front end search results.

    Default: value of the opposite of public argument
    'true' - site/?s=search-term will not include posts of this post type.
    'false' - site/?s=search-term will include posts of this post type.

    Note: If you want to show the posts's list that are associated to taxonomy's
    terms, you must set exclude_from_search to false (ie : for call
    site_domaine/?taxonomy_slug=term_slug or
    site_domaine/taxonomy_slug/term_slug). If you set to true, on the taxonomy
    page (ex: taxonomy.php) WordPress will not find your posts and/or pagination
    will make 404 error...
    */
    'exclude_from_search' => true,

    /*
    (boolean) (optional) Whether queries can be performed on the front end as
    part of parse_request().

    Default: value of public argument

    Note: The queries affected include the following (also initiated when
    rewrites are handled)
     ?post_type={post_type_key}
     ?{post_type_key}={single_post_slug}
     ?{post_type_query_var}={single_post_slug}
    Note: If query_var is empty, null, or a boolean FALSE, WordPress will still
    attempt to interpret it (4.2.2) and previews/views of your custom post will
    return 404s.
    */
    'publicly_queryable' => false,

    /*
    (boolean) (optional) Whether to generate a default UI for managing this post
    type in the admin.

    Default: value of public argument
    'false' - do not display a user-interface for this post type
    'true' - display a user-interface (admin panel) for this post type

    Note: _built-in post types, such as post and page, are intentionally set to
    false.
    */
    'show_ui' => false,

    /*
    (boolean) (optional) Whether post_type is available for selection in
    navigation menus.

    Default: value of public argument
    */
    'show_in_nav_menus' => false,

    /*
    (boolean or string) (optional) Where to show the post type in the admin
    menu. show_ui must be true.

    Default: value of show_ui argument
    'false' - do not display in the admin menu
    'true' - display as a top level menu
    'some string' - If an existing top level page such as 'tools.php' or
    'edit.php?post_type=page', the post type will be placed as a sub menu of
    that.

    Note: When using 'some string' to show as a submenu of a menu page created
    by a plugin, this item will become the first submenu item, and replace the
    location of the top-level link. If this isn't desired, the plugin that
    creates the menu page needs to set the add_action priority for admin_menu
    to 9 or lower.

    Note: As this one inherits its value from show_ui, which inherits its value
    from public, it seems to be the most reliable property to determine, if a
    post type is meant to be publicly useable. At least this works for _builtin
    post types and only gives back post and page.
    */
    'show_in_menu' => false,

    /*
    (boolean) (optional) Whether to make this post type available in the
    WordPress admin bar.

    Default: value of the show_in_menu argument
    */
    'show_in_admin_bar' => false,

    /*
    (integer) (optional) The position in the menu order the post type should
    appear. show_in_menu must be true.

    Default: null - defaults to below Comments

    5 - below Posts
    10 - below Media
    15 - below Links
    20 - below Pages
    25 - below comments
    60 - below first separator
    65 - below Plugins
    70 - below Users
    75 - below Tools
    80 - below Settings
    100 - below second separator
    */
    'menu_position' => null,

    /*
    (string) (optional) The url to the icon to be used for this menu or the name
    of the icon from the iconfont [1](https://github.com/WordPress/dashicons)

    Default: null - defaults to the posts icon

    Examples
    'dashicons-video-alt' (Uses the video icon from
    Dashicons[2](https://developer.wordpress.org/resource/dashicons/#universal-access-alt))

    'get_template_directory_uri() . "/images/cutom-posttype-icon.png"'
    (Use a image located in the current theme)

    'data:image/svg+xml;base64,' . base64_encode( "<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 459 459"> <path fill="black" d="POINTS"/></svg>" )'
    (directly embedding a svg with 'fill="black"' will allow correct colors.
    Also see [3](https://stackoverflow.com/questions/30620226/custom-svg-admin-menu-icon-in-wordpress/42265057#42265057))
    */
    'menu_icon' => null,

    /*
    (string or array) (optional) The string to use to build the read, edit, and
    delete capabilities. May be passed as an array to allow for alternative
    plurals when using this argument as a base to construct the capabilities,
    e.g. array('story', 'stories') the first array element will be used for the
    singular capabilities and the second array element for the plural
    capabilities, this is instead of the auto generated version if no array is
    given which would be "storys". The 'capability_type' parameter is used as a
    base to construct capabilities unless they are explicitly set with the
    'capabilities' parameter. It seems that `map_meta_cap` needs to be set to
    false or null, to make this work (see note 2 below).

    Default: "post"

    Example with "book" or "array( 'book', 'books' )" value, it's generate the 7
    capabilities equal to set capabilities parameter to this :
    'capabilities' => array(
      'edit_post'          => 'edit_book',
      'read_post'          => 'read_book',
      'delete_post'        => 'delete_book',
      'edit_posts'         => 'edit_books',
      'edit_others_posts'  => 'edit_others_books',
      'publish_posts'      => 'publish_books',
      'read_private_posts' => 'read_private_books',
      'create_posts'       => 'edit_books',
    ),

    Note 1: The "create_posts" capability correspond to "edit_books" so it
    become equal to "edit_posts".

    Note 2: See capabilities note 2 about meta capabilities mapping for custom
    post type.

    You can take a look into the $GLOBALS['wp_post_types']['your_cpt_name']
    array, then you'll see the following:
    [cap] => stdClass Object
      (
        // Meta capabilities
        [edit_post] => edit_book
        [read_post] => read_book
        [delete_post] => delete_book

        // Primitive capabilities used outside of map_meta_cap():
        [edit_posts] => edit_books
        [edit_others_posts] => edit_others_books
        [publish_posts] => publish_books
        [read_private_posts] => read_private_books

        // Primitive capabilities used within map_meta_cap():
        [create_posts] => edit_books
      )

    Some of the capability types that can be used (probably not exhaustive
    list):
    post (default)
    page
    These built-in types cannot be used:
    attachment
    mediapage
    Note 3: If you use capabilities parameter, capability_type complete your
    capabilities.
    */
    'capability_type' => 'post',

    /*
    (array) (optional) An array of the capabilities for this post type.

    Default: capability_type is used to construct

    By default, seven keys are accepted as part of the capabilities array:
    edit_post, read_post, and delete_post - These three are meta capabilities,
    which are then generally mapped to corresponding primitive capabilities
    depending on the context, for example the post being edited/read/deleted and
    the user or role being checked. Thus these capabilities would generally not
    be granted directly to users or roles.

    edit_posts - Controls whether objects of this post type can be edited.
    edit_others_posts - Controls whether objects of this type owned by other
    users can be edited. If the post type does not support an author, then this
    will behave like edit_posts.
    publish_posts - Controls publishing objects of this post type.
    read_private_posts - Controls whether private objects can be read.

    Note 1: those last four primitive capabilities are checked in core in
    various locations.
    There are also eight other primitive capabilities which are not referenced
    directly in core, except in map_meta_cap(), which takes the three
    aforementioned meta capabilities and translates them into one or more
    primitive capabilities that must then be checked against the user or role,
    depending on the context. These additional capabilities are only used in
    map_meta_cap(). Thus, they are only assigned by default if the post type is
    registered with the 'map_meta_cap' argument set to true (default is false).
    read - Controls whether objects of this post type can be read.
    delete_posts - Controls whether objects of this post type can be deleted.
    delete_private_posts - Controls whether private objects can be deleted.
    delete_published_posts - Controls whether published objects can be deleted.
    delete_others_posts - Controls whether objects owned by other users can be
    can be deleted. If the post type does not support an author, then this will
    behave like delete_posts.
    edit_private_posts - Controls whether private objects can be edited.
    edit_published_posts - Controls whether published objects can be edited.
    create_posts - Controls whether new objects can be created

    Note 2: In fact, when some user have a role with just the post type
    capabilies it isn't enough for create new object... It's because meta
    capabilities for custom post types were not being automatically mapped, so
    we couldn’t have granular control over permissions. To map meta capabilities
    for custom post types we can use map_meta_cap hook as it's explain here :
    http://justintadlock.com/archives/2010/07/10/meta-capabilities-for-custom-post-types.
    If you assign a 'capability_type' and then take a look into the
    $GLOBALS['wp_post_types']['your_cpt_name'] array, then you'll see the
    following:

    [cap] => stdClass Object
    (
      // Meta capabilities

      [edit_post]    => "edit_{$capability_type}"
      [read_post]    => "read_{$capability_type}"
      [delete_post]    => "delete_{$capability_type}"

      // Primitive capabilities used outside of map_meta_cap():

      [edit_posts]     => "edit_{$capability_type}s"
      [edit_others_posts]  => "edit_others_{$capability_type}s"
      [publish_posts]    => "publish_{$capability_type}s"
      [read_private_posts]   => "read_private_{$capability_type}s"

      // Primitive capabilities used within map_meta_cap():

      [read]                   => "read",
      [delete_posts]           => "delete_{$capability_type}s"
      [delete_private_posts]   => "delete_private_{$capability_type}s"
      [delete_published_posts] => "delete_published_{$capability_type}s"
      [delete_others_posts]    => "delete_others_{$capability_type}s"
      [edit_private_posts]     => "edit_private_{$capability_type}s"
      [edit_published_posts]   => "edit_published_{$capability_type}s"
      [create_posts]           => "edit_{$capability_type}s"
    )
    Note the "s" at the end of plural capabilities.
    */
    'capabilities' => null,

    /*
    (boolean) (optional) Whether to use the internal default meta capability
    handling.

    Default: null

    Note: If set it to false then standard admin role can't edit the posts
    types. Then the edit_post capability must be added to all roles to add or
    edit the posts types.
    */
    'map_meta_cap' => null,

    /*
    (boolean) (optional) Whether the post type is hierarchical (e.g. page).
    Allows Parent to be specified. The 'supports' parameter should contain
    'page-attributes' to show the parent select box on the editor page.

    Default: false

    Note: this parameter was intended for Pages. Be careful when choosing it for
    your custom post type - if you are planning to have very many entries (say
    - over 2-3 thousand), you will run into load time issues. With this
    parameter set to true WordPress will fetch all IDs of that particular post
    type on each administration page load for your post type. Servers with
    limited memory resources may also be challenged by this parameter being set
    to true.
    */
    'hierarchical' => false,

    /*
    (array/boolean) (optional) An alias for calling add_post_type_support()
    directly. As of 3.5, boolean false can be passed as value instead of an
    array to prevent default (title and editor) behavior.

    Default: title and editor

    'title'
    'editor' (content)
    'author'
    'thumbnail' (featured image, current theme must also support
      post-thumbnails)
    'excerpt'
    'trackbacks'
    'custom-fields'
    'comments' (also will see comment count balloon on edit screen)
    'revisions' (will store revisions)
    'page-attributes' (menu order, hierarchical must be true to show Parent
      option)
    'post-formats' add post formats, see Post Formats

    Note: When you use custom post type that use thumbnails remember to check
    that the theme also supports thumbnails or use add_theme_support function.
    */
    'supports' => array('title', 'editor'),

    /*
    (callback ) (optional) Provide a callback function that will be called when
    setting up the meta boxes for the edit form. The callback function takes one
    argument $post, which contains the WP_Post object for the currently edited
    post. Do remove_meta_box() and add_meta_box() calls in the callback.

    Default: None
    */
    'register_meta_box_cb' => null,

    /*
    (array) (optional) An array of registered taxonomies like category or
    post_tag that will be used with this post type. This can be used in lieu of
    calling register_taxonomy_for_object_type() directly. Custom taxonomies
    still need to be registered with register_taxonomy().

    Default: no taxonomies
    */
    'taxonomies' => array(),

    /*
    (boolean or string) (optional) Enables post type archives. Will use
    $post_type as archive slug by default.

    Default: false

    Note: Will generate the proper rewrite rules if rewrite is enabled. Also use
    rewrite to change the slug used. If string, it should be translatable.
    */
    'has_archive' => false,

    /*
    (boolean or array) (optional) Triggers the handling of rewrites for this
    post type. To prevent rewrites, set to false.

    Default: true and use $post_type as slug

    $args array
      'slug' => string Customize the permalink structure slug. Defaults to the
        $post_type value. Should be translatable.
      'with_front' => bool Should the permalink structure be prepended with the
        front base. (example: if your permalink structure is /blog/, then your
        links will be: false->/news/, true->/blog/news/). Defaults to true
      'feeds' => bool Should a feed permalink structure be built for this post
        type. Defaults to has_archive value.
      'pages' => bool Should the permalink structure provide for pagination.
        Defaults to true
      'ep_mask' => const As of 3.4 Assign an endpoint mask for this post type.
        For more info see Rewrite API/add_rewrite_endpoint, and Make WordPress
        Plugins summary of endpoints.

    If not specified, then it inherits from permalink_epmask(if permalink_epmask
    is set), otherwise defaults to EP_PERMALINK.

    Note: If registering a post type inside of a plugin, call
    flush_rewrite_rules() in your activation and deactivation hook (see Flushing
    Rewrite on Activation below). If flush_rewrite_rules() is not used, then you
    will have to manually go to Settings > Permalinks and refresh your permalink
    structure before your custom post type will show the correct structure.
    */
    'rewrite' => true,

    /*
    (string) (optional) The default rewrite endpoint bitmasks. For more info see
    Trac Ticket 12605 and this - Make WordPress Plugins summary of endpoints.

    Default: EP_PERMALINK
    */
    'permalink_epmask' => 'EP_PERMALINK',

    /*
    (boolean or string) (optional) Sets the query_var key for this post type.

    Default: true - set to $post_type

    'false' - Disables query_var key use. A post type cannot be loaded at
      /?{query_var}={single_post_slug}
    'string' - /?{query_var_string}={single_post_slug} will work as intended.

    Note: The query_var parameter has no effect if the ‘publicly_queryable’
    parameter is set to false. query_var adds the custom post type’s query var
    to the built-in query_vars array so that WordPress will recognize it.
    WordPress removes any query var not included in that array.

    If set to true it allows you to request a custom posts type (book) using
    this: example.com/?book=life-of-pi

    If set to a string rather than true (for example ‘publication’), you can do:
    example.com/?publication=life-of-pi
    */
    'query_var' => true,

    /*
    (boolean) (optional) Can this post_type be exported.

    Default: true
    */
    'can_export' => true,

    /*
    (boolean) (optional) Whether to delete posts of this type when deleting a
    user. If true, posts of this type belonging to the user will be moved to
    trash when then user is deleted. If false, posts of this type belonging to
    the user will not be trashed or deleted. If not set (the default), posts are
    trashed if post_type_supports('author'). Otherwise posts are not trashed or
    deleted.

    Default: null
    */
    'delete_with_user' => null,

    /*
    (boolean) (optional) Whether to expose this post type in the REST API.

    Default: false
    */
    'show_in_rest' => false,

    /*
    (string) (optional) The base slug that this post type will use when accessed
    using the REST API.

    Default: $post_type
    */
    'rest_base' => "$post_type",

    /*
    (string) (optional) An optional custom controller to use instead of
    WP_REST_Posts_Controller. Must be a subclass of WP_REST_Controller.

    Default: WP_REST_Posts_Controller
    */
    'rest_controller_class' => 'WP_REST_Posts_Controller'
  );

  register_post_type(
    /*
    (string) (required) Post type. (max. 20 characters, cannot contain capital
    letters or spaces)

    Default: None
    */
    'manufacturer',

    /*
    (array) (optional) An array of arguments.

    Default: None
    */
    $args
  );

}

add_action('init', 'custom_post_type', 0);