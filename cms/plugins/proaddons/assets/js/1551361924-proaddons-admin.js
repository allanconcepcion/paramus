!function() {

  var $ = jQuery;
  
  $(document).ready(function() {
    var sitemap = '';
    $('.js-run-update-sitemap').on('click touch', function( event ) {
      event.preventDefault();
      var headers = [];
      var items = [];

      // create headers array
      $('.js-sitemap-table thead th').each(function(index, item) {
        headers[index] = $(item).text().trim();
      });


      $('.js-sitemap-table tbody tr').has('td').each( function() {
        var itemArray = {};
        $('td', $(this)).each(function( index, item ) {
          if( $(item).find('select').length ) {
            itemArray[headers[index]] = $(item).find('select option:selected').data('post-id');
          } else {
            itemArray[headers[index]] = $(item).text().trim();
          }
        });
        items.push(itemArray);
      });

      var data = {
        action: 'run_sitemap_update',
        item: items,
        sitemap: sitemap
      }

      $.ajax({
        url: proaddons_ajax.ajax_url, 
        data: data,  
        type: 'post',
        success: function( response ) {
          $('.js-sitemap-form').show();
          $('.progressive-form__success').show();
          $('.js-sitemap-table-wrap').hide();
        }
      });

    });

    $('.js-select').select2({ width: '100%' });

        $(".js-grab-posts").on("click touch", function(event) {
      event.preventDefault();

      var siteUrl = $(".js-grab-posts-url")
        .val()
        .replace(/\/$/, "");

      $.ajax({
        url: siteUrl + "/wp-json/wp/v2/pages?per_page=100",
        beforeSend: function() {
          var form = $(".js-sitemap-form");
          $(".js-sitemap-form").css("min-height", form.outerHeight() + "px");
          $(".progressive-form__wrap").css("visibility", "hidden");
          $(".loader").addClass("loader--active");
        },
        success: function(data) {
          var template = $("#page-import-template").html();
          $.each(data, function(index, value) {
            var rendered = Mustache.render(template, {
              title: value.title.rendered,
              index: index,
              id: value.id
            });
            $(".table--create-page").removeClass("display--none");
            $(".js-grab-posts-url")
              .closest(".form")
              .addClass("display--none");
            $(".js-posts-table").append(rendered);
            $(".progressive-form__wrap").addClass("table-height-fix");
            //$(".js-select-import-pages").select2({ width: "100%" });
          });

          $(".js-build-posts").on("click touch", function(event) {
            event.preventDefault();
            var $this = $(this);

            var ajaxdata = {
              action: "run_page_builder",
              page: $this.data("page-id"),
              siteUrl: $(".js-grab-posts-url").val()
            };

            $.ajax({
              url: proaddons_ajax.ajax_url,
              data: ajaxdata,
              type: "post",
              beforeSend: function() {
                var buttonLoading =
                  '<span id="loading"><span>&bull;</span><span>&bull;</span><span>&bull;</span></span>';
                $this.html(buttonLoading);
                $this.attr("disabled", true);
              },
              success: function(response) {
                $this.parent("td").html("<span>Imported</span>");
              }
            });
          });
        },
        complete: function() {
          $(".progressive-form__wrap").css("visibility", "visible");
          $(".loader").removeClass("loader--active");
        },
        cache: false
      });
    });


    $('.js-search-replace-form').on('submit', function( event ) {
      event.preventDefault();
      var ajaxdata = $(this).serialize();
      $.ajax({
        url: proaddons_ajax.ajax_url, 
        data: ajaxdata,  
        type: 'post',
        success: function( response ) {
          $('.form').hide();
          $('.form--success').removeClass('display-none').show();
        }
      });
    });

    $('.js-devqc').on('click touch', function( event ) {

      event.preventDefault();
      var data = {
        action: 'check_website',
        state: $('input[name="state"]').val(),
        city: $('input[name="city"]').val()
      }

      $.ajax({
        url: proaddons_ajax.ajax_url, 
        data: data,  
        type: 'get',
        success: function( response ) {
          console.log( response );
          $('.js-qc-form').hide();
          $('.form--success').removeClass('display-none').show();
          $.each( response.data.links, function( key, link ) {
            $('.form--success').append('<p>Error: ' + link.message + '</p>');
          });

          $.each( response.data.contact, function( key, con) {
            $('.form--success').append('<p>Error: ' + con.message + '</p>');
          });

          $.each( response.data.noindex, function( key, ind ) {
            $('.form--success').append('<p>Error: ' + ind.message + '</p>');
          });

          $.each( response.data.nofollow, function( key, follow ) {
            $('.form--success').append('<p>Error: ' + follow.message + '</p>');
          });

          $.each( response.data.pages, function( key, page ) {
            if( page.count == "0" ) {
              $('.form--success').append('<p>Error:' + page.post_title + ' is missing an H1</p>' );
            }
            if( page.count > "1" ) {
              $('.form--success').append('<p>Error:' + page.post_title + ' has mutliple H1.</p>' );
            }

            if( page.missing == 'YES' ) {
              $('.form--success').append('<p>Error:' + page.post_title + ' is missing city and state in the H1.</p>' );
            }
          });

          $.each( response.data.plugins, function( key, plugin ) {
            if( plugin.status != "Active" ) {
              $('.form--success').append('<p>Error: ' + plugin.title + ' is not active.</p>' );
            }
          });

          $.each( response.data.seo, function( key, s ) {
            if( s.status != "Found" ) {
              $('.form--success').append('<p>Error: ' + s.title + ' was not found.</p>' );
            }
          });

          if (response.data.unpublished.length > 0 ) {
            $('.form--success').append('<p>Error: ' + response.data.unpublished.length + ' unpublished pages found.</p>' );
          }

          if( response.data.video.status != "Good" ) {
            $('.form--success').append('<p>Error: Video is ' + response.data.video.size + '.</p>' );
          }
          //Mustache.parse( template );
          // $.each( response.data.links, function( key, link ) {
          //   var template = $('#links-template').html();
          //   var rendered = Mustache.render( template, link);
          //   $('.dqc-accordion__panel--video .dqc-accordion__content').html( rendered );
            
          // });
          // $('.dqc-accordion__panel--plugins').addClass('checked');
          // $.each( response.data.plugins, function( key, plugin ) {
          //   var template = $('#plugins-template').html();
          //   var rendered = Mustache.render( template, plugin);
          //   $('.dqc-accordion__panel--plugins #the-list').append( rendered );
            
          // });


          // $('.dqc-accordion__panel--seo').addClass('checked');
          // $.each( response.data.seo, function( key, seo ) {
          //   var template = $('#seo-template').html();
          //   var rendered = Mustache.render( template, seo );
          //   $('.dqc-accordion__panel--seo #the-list').append( rendered );
          // });

          // $('.dqc-accordion__panel--unpublished').addClass('checked');
          // $.each( response.data.unpublished, function( key, pages ) {
          //   var template = $('#unpublished-template').html();
          //   var rendered = Mustache.render( template, pages );
          //   $('.dqc-accordion__panel--unpublished #the-list').append( rendered );
          // });

          // $('.dqc-accordion__panel--video').addClass('checked');
          // var template = $('#video-template').html();
          // var rendered = Mustache.render( template, response.data.video );
          // $('.dqc-accordion__panel--video #the-list').append( rendered );

          // $('.dqc-accordion__panel--pages').addClass('checked');
          // $.each( response.data.pages, function( key, pages ) {
          //   var template = $('#pages-template').html();
          //   var rendered = Mustache.render( template, pages );
          //   $('.dqc-accordion__panel--pages #the-list').append( rendered );
          // });
        }
      });
    });

    $('.js-upload-sitemap').on('change', function( event ) {
  
      var file = $(this);
      var fd = new FormData();
      var xlsx = file[0].files[0];
      fd.append("file", xlsx);
      fd.append('action', 'upload_sitemap');

      $.ajax({
        url: proaddons_ajax.ajax_url,
        data: fd,
        contentType: false,
        processData: false,
        type: 'post',
        beforeSend: function() {
          $('.js-sitemap-form').hide();
          $('.progressive-form__wrap').hide();
          $('.js-sitemap-table-wrap').show();
        },
        success: function( response ) {
          sitemap = response.data.sitemap;
          $.each( response.data.metadata, function( key, sitemap ) {
            var template = $('#test-template').html();
            var rendered = Mustache.render( template, sitemap);
            $('.js-sitemap-table #the-list').append( rendered );
          });
          console.log(response);
          $.each( response.data.sitemap, function( key, sitemap ) {
            if( sitemap.parent.length != 0 || sitemap.children == 0 ) {
              var template = $('#swiper-template').html();
              var rendered = Mustache.render( template, sitemap );
               $('.swiper-container .swiper-wrapper').append( rendered ).promise().done( function() {
                $.each( response.data.metadata, function( key, metadata ) {
                  var template = $('#option-template').html();
                  var rendered = Mustache.render( template, metadata);
                  $('.swiper-slide').last().find('.js-select-metadata-page').append(rendered).find();
                });
                $('.swiper-slide').last().find('.js-select-metadata-page').find('option:contains(' + sitemap.title + ')').prop('selected', true );

                $.each( response.data.pages, function( key, pages ) {
                  var template = $('#wp-option-template').html();
                  var rendered = Mustache.render( template, pages);
                  $('.swiper-slide').last().find('.js-select-wp-page').append(rendered).find();
                });
                $('.swiper-slide').last().find('.js-select-wp-page').find('option:contains(' + sitemap.title + ')').prop('selected', true );


               // js-select-wp-page
              // $('.js-sitemap-list tr').each( function() {
              //   var title = $(this).find('.column-title').text().trim();
              //   var select = $(this).find('.js-select-page');
              //   select.append( rendered );
              //   select.find('option:contains('+title+')').prop( 'selected', true );
              // });
              

              });
            }
           });
          var template = $('#final-slide').html();
          var rendered = Mustache.render( template, {} );
          $('.swiper-container .swiper-wrapper').append( rendered );
          $('.js-select-wp-page, .js-select-metadata-page').select2({ width: '100%' });

          $('.js-swiper-final').on('click touch', function() {
            var pages = [];

            $('.swiper-slide').each(function() {
              var selMetadata = $(this).find('.js-select-metadata-page').find(":selected");
              var selWp = $(this).find('select[name="wp-page"]').find(":selected");

              var page = {
                menuId: $(this).find('.pa-wizard__page-title').data('id'),
                menuParent: $(this).find('.pa-wizard__page-title').data('parent'),
                slug: selMetadata.data('slug'),
                title: selMetadata.data('title'),
                post_title: $(this).find('.pa-wizard__page-title span').text(),
                desc: selMetadata.data('desc'),
                wppage: selWp.data('post-id'),
                create: $(this).find('input[name="create_from_template"]').attr('checked'),
                blank: $(this).find('input[name="create_blank"]').attr('checked')
              }
              pages.push( page );

            });
            console.log(pages);

            var data = {
              action: 'run_user_sitemap',
              pages:  pages,
              sitemap: response.data.sitemap,
              metadata: response.data.metadata
            }

            $.ajax({
              url: proaddons_ajax.ajax_url, 
              data: data,  
              type: 'post',
              success: function( smresponse ) {
                $('.pa-progress, .pa-wizard h2, .swiper-container').hide();
                $('.pa-success').removeClass('display-none');
              }
            });
            
          });
        },
        complete: function() {
          //sitemapSwiper.update();

          $('.pa-wizard:last-child').removeClass('display-none');
          var sitemapSwiper = new Swiper('.swiper-container', {
            loop: false,
            slidesPerView: 1,
            allowTouchMove: false,
            navigation: {
              nextEl: '.js-swiper-next',
              prevEl: '.js-swiper-prev'
            },
          });
          
          sitemapSwiper.on('slideChange', function() {
            //console.log( $('.swiper-slide-active .js-select-wp-page').val() );
          });

          sitemapSwiper.on('slideChange', function () {
            var index = sitemapSwiper.activeIndex + 1;
            $('.pa-progress > span b:first-child').html( index );
            var total = $('.pa-wizard__step').length;
            $('.pa-progress__bar span').css('width', ( ( index / total ) * 100 ).toFixed(2) + '%' );
          });

          var total = $('.pa-wizard__step').length;
          $('.pa-progress > span b:last-child').html( total );
          $('.pa-progress__bar span').css('width', ( 100 / total ).toFixed(2) + '%' );
        }
      });
    });
  });
}();
