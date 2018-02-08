<?php
defined('_JEXEC') or die;

$document = JFactory::getDocument();
$modulePath = JURI::base() . 'modules/mod_linked_menu/assets/';
$document->addStyleSheet($modulePath.'css/linked_menu.css');
$jsonLeftSelection = json_encode($leftSelection, JSON_UNESCAPED_UNICODE);
$jsonRightSelection = json_encode($rightSelection, JSON_UNESCAPED_UNICODE);

$document->addScriptDeclaration("

    var leftSelection = JSON.parse('".$jsonLeftSelection."');
    var rightSelection = JSON.parse('".$jsonRightSelection."');

    window.onload = function(){
      var leftSelect = document.getElementById('leftSelect');
      leftSelect.innerHTML = '';
      var option = new Option('', 'empty_left_op');
      leftSelect.add(option);
      for (var i = 0; i < leftSelection.length; i++) {
        var text = leftSelection[i].title;
        var value = leftSelection[i].id;
        var option = new Option(text, value);
        leftSelect.add(option);
      }

      var rightSelect = document.getElementById('rightSelect');

      leftSelect.onchange = changeItemsRightSelect;

      function changeItemsRightSelect(ev) {
        var leftSelect = document.getElementById('leftSelect');
        var rightSelect = document.getElementById('rightSelect');
        rightSelect.innerHTML = '';
        var leftId = leftSelect.value;
        for (var i = 0; i < rightSelection.length; i++) {
          if (rightSelection[i].parentId == leftId) {
            var text = rightSelection[i].title;
            var id = rightSelection[i].id;
            var flink = rightSelection[i].flink;
            console.log(flink);
            var option = document.createElement('option');
            option.id = id;
            var a = document.createElement('a');
            a.innerHTML = text;
            a.href = flink;
            option.appendChild(a);
            rightSelect.add(option);
          }
        }
      }

      var buttonGo = document.getElementById('btLinkedList');
      buttonGo.onclick = function(e) {
        var leftSelect = document.getElementById('leftSelect');
        localStorage.setItem('leftSelectIndex', leftSelect.selectedIndex);
        var rightSelect = document.getElementById('rightSelect');
        localStorage.setItem('rightSelectIndex', rightSelect.selectedIndex);
        if(rightSelect.selectedIndex == -1)
          return;
        var rightSelectOption = rightSelect.options[rightSelect.selectedIndex];
        var href = rightSelectOption.getElementsByTagName('a')[0].href;
        document.location.href = href;
      }

      if(localStorage.getItem('leftSelectIndex') != null &&
        localStorage.getItem('rightSelectIndex') != null)
      {
        leftSelect.selectedIndex = localStorage.getItem('leftSelectIndex');
        changeItemsRightSelect();
        localStorage.removeItem('leftSelectIndex');
        rightSelect.selectedIndex = localStorage.getItem('rightSelectIndex');
        localStorage.removeItem('rightSelectIndex');
      }
    }");
?>

<div class="<?php echo $classDiv ?>">
    <select id="leftSelect" class="<?php echo $classSelectLeft ?>">
        <option value="empty" selected></option>
    </select>
    <select id="rightSelect" class="<?php echo $classSelectRight ?>">
    </select>
    <button id="btLinkedList" class="<?php echo $classBtLinkedList ?>">
      <?php echo $btTitle ?></button>
</div>
