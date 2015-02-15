// Script for tabbed menu


function tabview_aux(TabViewId, id)
{
  var TabView = document.getElementById(TabViewId);

  // ----- Tabs -----

  var spw_tabs = TabView.firstChild;
  while (spw_tabs.className != "spw_tabs" ) spw_tabs = spw_tabs.nextSibling;

  var Tab = spw_tabs.firstChild;
  var i   = 0;

  do
  {
    if (Tab.tagName == "A")
    {
      i++;
      Tab.href      = "javascript:tabview_switch('"+TabViewId+"', "+i+");";
      Tab.className = (i == id) ? "Active" : "";
      Tab.blur();
    }
  }
  while (Tab = Tab.nextSibling);

  // ----- spw_widget -----

  var spw_widget = TabView.firstChild;
  while (spw_widget.className != 'spw_widget') spw_widget = spw_widget.nextSibling;

  var spw_content = spw_widget.firstChild;
  var i    = 0;

  do
  {
    if (spw_content.className == 'spw_content')
    {
      i++;
      if (spw_widget.offsetHeight) spw_content.style.height = (spw_widget.offsetHeight-2)+"px";
      spw_content.style.overflow = "auto";
      spw_content.style.display  = (i == id) ? 'block' : 'none';
    }
  }
  while (spw_content = spw_content.nextSibling);
}

// ----- Functions -------------------------------------------------------------

function tabview_switch(TabViewId, id) { tabview_aux(TabViewId, id); }

function tabview_initialize(TabViewId) { tabview_aux(TabViewId,  1); }
