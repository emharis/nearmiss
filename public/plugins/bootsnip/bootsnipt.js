var theTree;
var idNum = 1;
$.fn.extend({
    treed: function (o) {
        var openedClass = 'glyphicon-minus-sign';
        var closedClass = 'glyphicon-plus-sign';

        if (typeof o != 'undefined') {
            if (typeof o.openedClass != 'undefined') {
                openedClass = o.openedClass;
            }
            if (typeof o.closedClass != 'undefined') {
                closedClass = o.closedClass;
            }
        }
        ;

        //initialize each of the top levels
        var tree = $(this);
        theTree = $(this);
        tree.addClass("tree");
//        tree.find('li').has("ul").each(function () {
//            //add unique data id            
//            $(this).attr('data-id', idNum++);
//            var branch = $(this); //li with children ul
//            branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
//            branch.addClass('branch');
////            branch.on('click', function (e) {
//////                alert(4);
////                if (this == e.target) {
////                    var icon = $(this).children('i:first');
////                    icon.toggleClass(openedClass + " " + closedClass);
////                    $(this).children().children().slideToggle(200);
//////                    $(this).children().children().toggle();
////                }
////            })
//
//            branch.children().children().slideToggle(200);
////            branch.children().children().toggle();
//        });
//        $(document).on('click', '.tree>li:has(ul)', function (e) {
////                alert(4);
//            if (this == e.target) {
//                var icon = $(this).children('i:first');
//                icon.toggleClass(openedClass + " " + closedClass);
//                $(this).children().children().slideToggle(200);
////                    $(this).children().children().toggle();
//            }
//        });
        //fire event from the dynamically added icon
//        tree.find('.branch .indicator').each(function () {
//            var obj = $(this);
////            $(document).on('click',$(this),function(){
//            $(this).on('click', function (e) {
//                obj.closest('li').click();
////                $(this).closest('li').click();
//                e.preventDefault();
//            });
//        });
        //fire event to open branch if the li contains an anchor instead of text
//        tree.find('.branch>a').each(function () {
//            var obj = $(this);
////            $(document).on('click',$(this),function(e){
//            $(this).on('click', function (e) {
////                $(this).closest('li').click();
//                obj.closest('li').click();
//                e.preventDefault();
//            });
//        });
        //fire event to open branch if the li contains a button instead of text
//        tree.find('.branch>button').each(function () {
//            var obj = $(this);
//            $(this).on('click', function (e) {
////            $(document).on('click',$(this),function(e){
////                $(this).closest('li').click();
//                obj.closest('li').click();
//                e.preventDefault();
//            });
//        });
//        tree.find('li').not(".branch").each(function () {
//            var li = $(this);
//            li.on('click', function (e) {
//                return false;
//            });
//        });
//        $(document).on('click', '.tree>li:has(ul)', function (e) {
//            if (this == e.target) {
//                alert('togling');
//                var icon = $(this).children('i:first');
//                icon.toggleClass(openedClass + " " + closedClass);
//                $(this).children().children().slideToggle(200);
//            }
//        })
        $('.tree').find('li').has('ul').each(function () {
            $(this).prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
            $(this).addClass('branch');
            $(this).children().children().slideToggle(200);
        });
    },
    newMaster: function (obj) {
        obj = JSON.parse(obj);
        var lastLi = theTree.children('li:last');
        lastLi.before('<li class="branch"><i class="indicator glyphicon glyphicon-plus-sign" ></i><a href="#" >' + obj.nama + '</a><ul>\n\
            <li><i class="indicator glyphicon glyphicon-circle-arrow-right" ></i> <a href="#" data-posturl="master/permit/new-sub-permit" data-parentname="' + obj.nama + '" data-parentid="' + obj.id + '" class="btn-input-sub" style="color: orangered;" ><< input detil >></a></li>\n\
            </ul></li>');
        lastLi.prev().children().children().toggle();
        lastLi.prev().hide();
        lastLi.prev().slideDown(250);
        return false;
    },
    newSub: function (trigger, obj) {
        if (trigger.is('a')) {
            var liTrigger = trigger.parent();
        } else if (trigger.is('li')) {
            var liTrigger = trigger;
        }
        var lastLi = liTrigger;
        lastLi.before('<li class="branch"><i class="indicator glyphicon glyphicon-plus-sign" ></i><a href="#" >' + obj.nama + '</a><ul>\n\
            <li><i class="indicator glyphicon glyphicon-circle-arrow-right" ></i> <a href="#" data-posturl="master/permit/new-sub-detil-permit" data-master="' + obj.permit.nama + '" data-parentname="' + obj.nama + '" data-parentid="' + obj.id + '" class="btn-input-detil" style="color: orangered;" ><< input detil >></a></li>\n\
            </ul></li>');
        lastLi.prev().children().children().toggle();
        lastLi.prev().hide();
        lastLi.prev().slideDown(250);
        return false;
    },
    newSubDetil: function (trigger, obj) {
        if (trigger.is('a')) {
            var liTrigger = trigger.parent();
        } else if (trigger.is('li')) {
            var liTrigger = trigger;
        }
        var lastLi = liTrigger;
        lastLi.before('<li class="branch"><a href="#" >' + obj.nama + '</a><ul></ul></li>');
        lastLi.prev().children().children().toggle();
        lastLi.prev().hide();
        lastLi.prev().slideDown(250);
        return false;
    }

});

$(document).on('click', '.tree li', function (e) {
    if ($(this).hasClass('branch')) {
        var icon = $(this).children('i:first');
        icon.toggleClass("glyphicon-minus-sign glyphicon-plus-sign");
        $(this).children().children().slideToggle(200);
    }
    return false;
});

//memunculkan edit icon dan delete icon
//$(document).on('mouseover', '.tree li', function () {
//    var li = $(this);
//    if(li.children('a.btn-del-permit').length == 0){
//        li.children('a').after('<a class="btn-del-permit pull-right" ><i class="fa fa-trash-o" ></i></a>');
//    }
//        
//    
//});
//$(document).on('mouseleave', '.tree li', function () {
//    var li = $(this);
//    li.children('a.btn-del-permit').remove();
//});



//$(document).on('click', '.tree>li>a', function (e) {
//    var trigger = $(this);
//    alert(trigger.get(0).tagName)
//////    alert($(this).tagName());
//    
//    
////    if (this == e.target) {
////        if ($(this).is('a')) {
////            var trigger = $(this).parent('li');
////        } else {
////            var trigger = $(this);
////        }
////        var icon = trigger.children('i:first');
////        icon.toggleClass("glyphicon-minus-sign glyphicon-plus-sign");
////        trigger.children().children().slideToggle(200);
////    }
//
//    return false;
//});