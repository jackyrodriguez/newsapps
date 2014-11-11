//select category
  function myFunction(selTag) {
    var categoryName = selTag.options[selTag.selectedIndex].text;
    document.getElementById("catname").value = categoryName;
  }
