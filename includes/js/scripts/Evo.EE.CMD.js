nuke_jq(function($){
  $(window).jKonamicode(function(){
   var left = (screen.width - 1280) / 2;
   var top = (screen.height - 720) / 4;
    window.open("./includes/custom_files/evo_ee/evoee.php", "_blank", "resizable=0, scrollbars=0, titlebar=0, toolbar=0, menubar=0, top=" + top + ", left=" + left + ", width=1280, height=720");
  });
});

nuke_jq(function($){
  $(window).jKonamicode({
      code:[69,86,79,87,72,79,65,77,73], <!-- evowhoami -->
    },
     function(){
   var left = (screen.width - 400) / 2;
   var top = (screen.height - 175) / 4;
    window.open("./includes/custom_files/evo_ee/graph.htm", "_blank", "resizable=0, scrollbars=0, titlebar=0, toolbar=0, menubar=0, top=" + top + ", left=" + left + ", width=400, height=175");
  });
});

nuke_jq(function($){
  $(window).jKonamicode({
      code:[69,86,79,65,78,83,87,69,82], <!-- evoanswer -->
    },
     function(){
      alert("Answer to the Ultimate Question of Life, the Universe, and Everything?\n...\n...\n...\n42");
     }
  );
});