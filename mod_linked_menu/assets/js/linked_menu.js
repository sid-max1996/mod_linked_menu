var leftSelection = JSON.parse(jsonLeftSelection);
var rightSelection = JSON.parse(jsonRightSelection);
var aClass = 'trigger';
var aActClass = 'activetrigger';
var ulClass = 'dropdownhidden';
var ulActClass = 'dropdownvisible';
var selectItems = [];
selectItems.push(leftSelection);
selectItems.push(rightSelection);

jQuery(document).ready(function() {
  console.log(leftSelection);
  console.log(rightSelection);

  var $selectDiv0 = jQuery('#selectDiv0');
  var $ul = $selectDiv0.children('div.dropcontainer').children('ul');
  var firtItems = selectItems[0];
  for (var i = 0; i < firtItems.length; i++) {
    var text = firtItems[i].title;
    var id = firtItems[i].id;
    $ul.append('<li id="' + id + '"><a href="">'+ text +'</a></li>' );
  }

  function toggleDropDownClasses($a, $ul){
    $a.toggleClass(aClass);
    $a.toggleClass(aActClass);
    $ul.toggleClass(ulClass);
    $ul.toggleClass(ulActClass);
  }

  jQuery('div.selectDiv').on('click', function(event) {
    var $a = jQuery(this).children("a");
    var $ul = jQuery(this).children('div.dropcontainer').children('ul');
    toggleDropDownClasses($a, $ul);
  });

  jQuery('div.dropcontainer').on('click', 'li', function(event) {
    event.preventDefault();
    var text = jQuery(this).text();
    jQuery(this).parent().parent().siblings('a').text(text);
    var id = jQuery(this).attr('id');
    var href = jQuery(this).children('a').attr('href');
    var $input = jQuery(this).parent().parent().siblings('input');    
    $input.attr('id', id).attr('value', href);
    //the next change
    var $selDiv = jQuery(this).parent().parent().parent();
    if ($selDiv.attr('id').replace('selectDiv', '') == 0){
      ChangeItems(1, id);
    }
    if ($selDiv.attr('id').replace('selectDiv', '') == 1){
      var $selectDiv = jQuery('#selectDiv0');
      var $a = $selectDiv.children('a');
      if ($a.hasClass('activetrigger')){
        $ul = $a.siblings('div.dropcontainer').children('ul');
        toggleDropDownClasses($a, $ul);  
      }
    }
  });

  function ChangeItems(selIdNum, parentItemId){
    var $selectDiv = jQuery('#selectDiv'+selIdNum); 
    var $input = $selectDiv.children('input');
    $input.attr('id', '');
    $input.attr('value', '');  
    var $a = $selectDiv.children('a');
    $ul = $a.siblings('div.dropcontainer').children('ul');
    $ul.html('');
    if ($a.hasClass('activetrigger'))
      toggleDropDownClasses($a, $ul);  
    $a.text('');
    var curItems = selectItems[parseInt(selIdNum)];
    for (var i = 0; i < curItems.length; i++) {
      var curItem = curItems[i];
      if (curItem.parentId == parentItemId) {
        var text = curItem.title;
        var id = curItem.id;
        var flink = curItem.flink;
        $ul.append('<li id="' + id + '"><a href="'+ flink +'" >' 
          + text + '</a></li>' );
      }
    }
  }

  jQuery('#btLinkedList').on('click', function(event) {
    var $input = jQuery('#selectDiv1 input');
    var lastId = parseInt($input.attr('id'));
    var lastHref = $input.attr('value');
    if (!Number.isInteger(lastId))
      return;
    var firstId = jQuery('#selectDiv0 input').attr('id');
    var firstText = jQuery('#selectDiv0 > a').text();
    var lastText = jQuery('#selectDiv1 > a').text();
    localStorage.setItem('lmBtFlag', 'true');
    localStorage.setItem('lmId0', firstId);
    localStorage.setItem('lmId1', lastId);
    localStorage.setItem('lmText0', firstText);
    localStorage.setItem('lmText1', lastText);
    localStorage.setItem('lmHref', lastHref);
    document.location.href = lastHref;
  });

  if(localStorage.getItem('lmBtFlag') != null)
  {
    var firstId = localStorage.getItem('lmId0');
    var $input0 = jQuery('#selectDiv0 > input');
    $input0.attr('id', firstId);
    ChangeItems(1, firstId);
    var $input1 = jQuery('#selectDiv1 > input'); 
    var lastId = localStorage.getItem('lmId1');
    $input1.attr('id', lastId);
    var lastHref = localStorage.getItem('lmHref');
    $input1.attr('value', lastHref);
    var firstText = localStorage.getItem('lmText0');  
    var lastText = localStorage.getItem('lmText1');
    jQuery('#selectDiv0 > a').text(firstText);
    jQuery('#selectDiv1 > a').text(lastText);
    localStorage.removeItem('lmBtFlag');
  }

});

