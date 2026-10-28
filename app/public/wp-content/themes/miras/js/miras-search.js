(function() {
    'use strict';
    var overlay  = document.getElementById('miras-search-overlay');
    var trigger  = document.getElementById('miras-search-trigger');
    var closeBtn = document.getElementById('miras-search-close');
    var backdrop = document.getElementById('miras-search-backdrop');
    if (!overlay || !trigger) return;

    function getSearchInput() {
        return overlay.querySelector('input[type="search"], input.dgwt-wcas-search-input, .miras-search-input-native');
    }
    function openSearch() {
        overlay.classList.add('is-open');
        document.body.classList.add('miras-search-open');
        setTimeout(function() {
            var inp = getSearchInput();
            if (inp) inp.focus();
        }, 200);
    }
    function closeSearch() {
        overlay.classList.remove('is-open');
        document.body.classList.remove('miras-search-open');
    }
    trigger.addEventListener('click', openSearch);
    if (closeBtn) closeBtn.addEventListener('click', closeSearch);
    if (backdrop) backdrop.addEventListener('click', closeSearch);
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && overlay.classList.contains('is-open')) {
            closeSearch();
        }
    });
    window.fillSearch = function(term) {
        var inp = getSearchInput();
        if (inp) {
            inp.value = term;
            inp.dispatchEvent(new Event('input'));
            inp.dispatchEvent(new KeyboardEvent('keyup'));
            inp.focus();
        }
    };
})();