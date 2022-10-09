/*************************************************************
* This was suddenly missing because someone removed it at
* some point without telling anyone or asking! It is a vital
* part of the quick reply mod. Added back 10/08/2022 TheGhost
*************************************************************/
function sqr_show_hide()
{
  var id = 'sqr';
  var item = null;

   if (document.getElementById)
   {
      item = document.getElementById(id);
   }
   else if (document.all)
   {
      item = document.all[id];
   }
   else if (document.layers)
   {
     item = document.layers[id];
   }

   if (item && item.style)
   {
     if (item.style.display == "none")
     {
       item.style.display = "";
     }
     else
        {
          item.style.display = "none";
        }
   }
   else if (item)
   {
     item.visibility = "show";
   }
}
