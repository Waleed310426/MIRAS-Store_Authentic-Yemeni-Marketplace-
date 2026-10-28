/**
 * MIRAS Customizer Live Preview
 * تحديثات فورية بدون إعادة تحميل الصفحة
 */
( function( $, api ) {

    /* ── الألوان ── */
    api( 'miras_color_primary', function( value ) {
        value.bind( function( newval ) {
            document.documentElement.style.setProperty( '--miras-primary', newval );
        } );
    } );

    api( 'miras_color_primary_dark', function( value ) {
        value.bind( function( newval ) {
            document.documentElement.style.setProperty( '--miras-primary-dark', newval );
        } );
    } );

    api( 'miras_color_gold', function( value ) {
        value.bind( function( newval ) {
            document.documentElement.style.setProperty( '--miras-gold', newval );
        } );
    } );

    api( 'miras_color_ivory', function( value ) {
        value.bind( function( newval ) {
            document.documentElement.style.setProperty( '--miras-ivory', newval );
        } );
    } );

    api( 'miras_color_charcoal', function( value ) {
        value.bind( function( newval ) {
            document.documentElement.style.setProperty( '--miras-charcoal', newval );
        } );
    } );

    /* ── الخطوط ── */
    api( 'miras_h1_size', function( value ) {
        value.bind( function( newval ) {
            $( 'h1' ).css( 'font-size', newval );
        } );
    } );

    api( 'miras_h2_size', function( value ) {
        value.bind( function( newval ) {
            $( 'h2' ).css( 'font-size', newval );
        } );
    } );

    api( 'miras_body_size', function( value ) {
        value.bind( function( newval ) {
            $( 'body' ).css( 'font-size', newval );
        } );
    } );

    /* ── الحواف الدائرية ── */
    api( 'miras_border_radius', function( value ) {
        value.bind( function( newval ) {
            document.documentElement.style.setProperty( '--miras-card-radius', newval );
        } );
    } );

    /* ── نصوص الهيدر ── */
    api( 'miras_header_shop_btn', function( value ) {
        value.bind( function( newval ) {
            $( '.header-btn-shop, .btn-shop-now' ).text( newval );
        } );
    } );

    api( 'miras_header_login_btn', function( value ) {
        value.bind( function( newval ) {
            $( '.header-btn-login, .btn-login' ).text( newval );
        } );
    } );

    api( 'miras_search_placeholder', function( value ) {
        value.bind( function( newval ) {
            $( '.header-search input[type="search"], .search-field' ).attr( 'placeholder', newval );
        } );
    } );

    /* ── الفوتر ── */
    api( 'miras_footer_copyright', function( value ) {
        value.bind( function( newval ) {
            $( '.footer-copyright, .copyright-text' ).text( newval );
        } );
    } );

    api( 'miras_footer_description', function( value ) {
        value.bind( function( newval ) {
            $( '.footer-description, .footer-about-text' ).text( newval );
        } );
    } );

} )( jQuery, wp.customize );