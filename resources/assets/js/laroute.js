(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http:127.0.0.1',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"admin","name":"admin.index","action":"App\Http\Controllers\Admin\AdminController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"index-admin","name":"auth.index-admin","action":"App\Http\Controllers\Admin\AdminController@indexAdmin"},{"host":null,"methods":["GET","HEAD"],"uri":"auth-google\/{auth?}","name":"auth-google","action":"App\Http\Controllers\Admin\AssistenceController@getGoogleLogin"},{"host":null,"methods":["GET","HEAD"],"uri":"assistence","name":"assistence.index","action":"App\Http\Controllers\Admin\AssistenceController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"assistence\/create","name":"assistence.create","action":"App\Http\Controllers\Admin\AssistenceController@create"},{"host":null,"methods":["POST"],"uri":"assistence","name":"assistence.store","action":"App\Http\Controllers\Admin\AssistenceController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"assistence\/{assistence}","name":"assistence.show","action":"App\Http\Controllers\Admin\AssistenceController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"assistence\/{assistence}\/edit","name":"assistence.edit","action":"App\Http\Controllers\Admin\AssistenceController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"assistence\/{assistence}","name":"assistence.update","action":"App\Http\Controllers\Admin\AssistenceController@update"},{"host":null,"methods":["DELETE"],"uri":"assistence\/{assistence}","name":"assistence.destroy","action":"App\Http\Controllers\Admin\AssistenceController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"assistences\/logout-google","name":"logout-google","action":"App\Http\Controllers\Admin\AssistenceController@getGoogleLogout"},{"host":null,"methods":["GET","HEAD"],"uri":"type-product","name":"type-product.index","action":"App\Http\Controllers\App\TypeProductController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"type-product\/create","name":"type-product.create","action":"App\Http\Controllers\App\TypeProductController@create"},{"host":null,"methods":["POST"],"uri":"type-product","name":"type-product.store","action":"App\Http\Controllers\App\TypeProductController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"type-product\/{type_product}","name":"type-product.show","action":"App\Http\Controllers\App\TypeProductController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"type-product\/{type_product}\/edit","name":"type-product.edit","action":"App\Http\Controllers\App\TypeProductController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"type-product\/{type_product}","name":"type-product.update","action":"App\Http\Controllers\App\TypeProductController@update"},{"host":null,"methods":["DELETE"],"uri":"type-product\/{type_product}","name":"type-product.destroy","action":"App\Http\Controllers\App\TypeProductController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"brands-attended","name":"brands-attended.index","action":"App\Http\Controllers\App\BrandsAttendedController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"brands-attended\/create","name":"brands-attended.create","action":"App\Http\Controllers\App\BrandsAttendedController@create"},{"host":null,"methods":["POST"],"uri":"brands-attended","name":"brands-attended.store","action":"App\Http\Controllers\App\BrandsAttendedController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"brands-attended\/{brands_attended}","name":"brands-attended.show","action":"App\Http\Controllers\App\BrandsAttendedController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"brands-attended\/{brands_attended}\/edit","name":"brands-attended.edit","action":"App\Http\Controllers\App\BrandsAttendedController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"brands-attended\/{brands_attended}","name":"brands-attended.update","action":"App\Http\Controllers\App\BrandsAttendedController@update"},{"host":null,"methods":["DELETE"],"uri":"brands-attended\/{brands_attended}","name":"brands-attended.destroy","action":"App\Http\Controllers\App\BrandsAttendedController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"assistence-request","name":"assistence-request.index","action":"App\Http\Controllers\Admin\AssistenceRequestController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"assistence-request\/{assistence_request}","name":"assistence-request.show","action":"App\Http\Controllers\Admin\AssistenceRequestController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"assistence-request\/{assistence_request}\/edit","name":"assistence-request.edit","action":"App\Http\Controllers\Admin\AssistenceRequestController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"assistence-request\/{assistence_request}","name":"assistence-request.update","action":"App\Http\Controllers\Admin\AssistenceRequestController@update"},{"host":null,"methods":["DELETE"],"uri":"assistence-request\/{assistence_request}","name":"assistence-request.destroy","action":"App\Http\Controllers\Admin\AssistenceRequestController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"search-assistence","name":"search-assistence.index","action":"App\Http\Controllers\App\AssistenceController@index"},{"host":null,"methods":["POST"],"uri":"search-assistence","name":"search-assistence.store","action":"App\Http\Controllers\App\AssistenceController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"search-assistence\/{search_assistence}","name":"search-assistence.show","action":"App\Http\Controllers\App\AssistenceController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"assistence-solicitation","name":"assistence-solicitation.create","action":"App\Http\Controllers\App\AssistenceRequestController@create"},{"host":null,"methods":["POST"],"uri":"assistence-solicitation","name":"assistence-solicitation.store","action":"App\Http\Controllers\App\AssistenceRequestController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"index","name":"index","action":"App\Http\Controllers\Auth\AuthController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":"index","action":"App\Http\Controllers\Auth\AuthController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"login","name":"auth.login","action":"App\Http\Controllers\Auth\AuthController@login"},{"host":null,"methods":["POST"],"uri":"login","name":"auth.authenticate","action":"App\Http\Controllers\Auth\AuthController@authenticate"},{"host":null,"methods":["GET","HEAD"],"uri":"logout","name":"auth.logout","action":"App\Http\Controllers\Auth\AuthController@logout"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                return this.getCorrectUrl(uri + qs);
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if(!this.absolute)
                    return url;

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

