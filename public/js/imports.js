'use strict';


async function loadComponents() {
    var includes = $('[data-include]')
    var promises = [];
    $.each(includes, async function () {
        var file = 'components/' + $(this).data('include') + '.html';
        // console.log("start");
        const promise = loadAsPromise(this, file);
        promises.push(promise);
    });

    return Promise.all(promises);

    // promise.resolve();
};

async function loadAsPromise(element, src) {
    var resolveFunction;
    const loadPromise = new Promise(function(resolve, _) {
        resolveFunction = resolve;
    });

    $(element).load(src, function () {
        // console.log("SOLVED");
        resolveFunction();
    });

    return loadPromise;
}

export {
    loadAsPromise,
    loadComponents,
}

