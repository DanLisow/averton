// jQuery(function ($) {

//     $("input[name=search]").autocomplete({
//         source: function (request, response) {
//             $.ajax({
//                 url: ajax.ajax_url,
//                 data: {
//                     action: 'websearch',
//                     term: request.term
//                 },
//                 success: function (data) {
//                     response(data);
//                 }
//             });
//             response();
//         },
//         delay: 0,
//         appendTo: ".search__result",
//         minLength: 3,
//         open: function (event, ui) {
//             $('.search__result').fadeIn(300);
//         },
//         close: function (event, ui) {
//             $('.search__result').fadeOut(300);
//         },
//         select: function (event, ui) {
//             window.location = ui.item.url
//         }
//     });


// });