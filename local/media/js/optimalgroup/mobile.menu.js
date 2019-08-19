OptimalGroup.MobileMenu = {
    menuLi: {},
    mainMenu:function(){
        var li = {},
            og = this,
            gIndex = 0;
        $('.main-menu > li').each(function(index){
            var current = $(this).find('>a'),
                secondChild = $(this).find('>.menu-container'),
                teploChild = $(this).find('>.menu-list'),
                li = {
                    'href': current.attr('href'),
                    'name': current.text()
                };
                
            if (secondChild.length){
                if (!secondChild.find('.service-menu').length){
                    li.sub_menu = {};
                }
                secondChild.find('.main-menu--second-level a').each(function(i){
                    var link = {
                            'name': $(this).text(),
                            'href': $(this).attr('href')
                        }
                    li.sub_menu[i] = link;
                });
                /*if (secondChild.find('.service-menu').length) {
                    secondChild.find('.service-menu').each(function(i){
                        var SectionName = $(this).find('.product-links--title a');
                        var link = {
                            'name': SectionName.text(),
                            'href': SectionName.attr('href'),
                        }
                        if ($(this).find('.product-links').length){
                            link.sub_menu = {};
                            $(this).find('.product-links a').each(function(k){
                                var serviceLink = {
                                    'name': $(this).text(),
                                    'href': $(this).attr('href')
                                }
                                link.sub_menu[k] = serviceLink;
                            });
                        }
                        li.sub_menu[i] = link;
                    });
                }*/
                
            }
            if (teploChild.length){
                li.sub_menu = {};
                teploChild.find('li a').each(function(i){
                    var link = {
                            'name': $(this).text(),
                            'href': $(this).attr('href')
                        }
                    li.sub_menu[i] = link;
                });            
            }
            og.menuLi[index] = li;
            gIndex++;
        });
        if($('.js-FooterService').length){
            var li = {
                "name": $('.js-FooterService .footer-menu--title').text(),
                "href": "#",
                "sub_menu": {}
            }
            $('.js-FooterService').find('.footer-menu a').each(function(i){
                var link = {
                        'name': $(this).text(),
                        'href': $(this).attr('href')
                    };
                li.sub_menu[i] = link;
            });
            og.menuLi[gIndex++] = li;
        }
        if ($('.js-ToMobileMenu').length){
            $('.js-ToMobileMenu').each(function(index){
                var li = {
                    'name': $(this).text(),
                    'href': $(this).attr('href')
                };
                og.menuLi[gIndex++] = li;
            });
        }
    },
    pushToMenu: function(){
        var html = "";
        for (var i in this.menuLi){
            var li = this.menuLi[i];
            if (li.sub_menu){
                html += '<li><a href="'+li.href+'" class="js-MainMenu">'+li.name+' <i class="fa fa-angle-right"></i></a>\
                <ul class="no-list second-level none">';
                for (var k in li.sub_menu){
                    var liS = li.sub_menu[k];
                    html += '<li><a href="'+liS.href+'">'+liS.name+'</a></li>';
                }
                html += '</ul></li>';
            }
            else {
                html += '<li><a href="'+li.href+'">'+li.name+'</a></li>';
            }
        }
        $('.mobile-menu').append(html);
    },
    init: function(){
        this.mainMenu();
        this.pushToMenu();
    }
};