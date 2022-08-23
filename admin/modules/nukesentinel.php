<?php
/*======================================================================= 
  PHP-Nuke Titanium | Nuke-Evolution Xtreme : PHP-Nuke Web Portal System
 =======================================================================*/


/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://nukescripts.86it.us)     */
/* Copyright (c) 2000-2008 by NukeScripts(tm)           */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if (!defined('ADMIN_FILE')) {
   die ("Illegal File Access");
}

@set_time_limit(600);

if($ab_config['show_right'] == 1) {
  define('INDEX_FILE', TRUE);
}

if (is_mod_admin()) {

  define('NUKESENTINEL_ADMIN', TRUE);
  include_once(NUKE_ADMIN_MODULE_DIR.'nukesentinel/functions.php');
  if(!defined('NUKESENTINEL_IS_LOADED')) { $op = 'ABLoadError'; }

  switch ($op) {
    case 'ABAuth':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABAuth.php');break;
    case 'ABAuthEdit':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABAuthEdit.php');break;
    case 'ABAuthEditSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABAuthEditSave.php');break;
    case 'ABAuthList':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABAuthList.php');break;
    case 'ABAuthResend':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABAuthResend.php');break;
    case 'ABAuthScan':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABAuthScan.php');break;
    case 'ABBlockedIPAdd':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedIPAdd.php');break;
    case 'ABBlockedIPAddSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedIPAddSave.php');break;
    case 'ABBlockedIPClear':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedIPClear.php');break;
    case 'ABBlockedIPClearExpired':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedIPClearExpired.php');break;
    case 'ABBlockedIPClearSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedIPClearSave.php');break;
    case 'ABBlockedIPDelete':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedIPDelete.php');break;
    case 'ABBlockedIPDeleteSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedIPDeleteSave.php');break;
    case 'ABBlockedIPEdit':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedIPEdit.php');break;
    case 'ABBlockedIPEditSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedIPEditSave.php');break;
    case 'ABBlockedIPList':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedIPList.php');break;
    case 'ABBlockedIPListPrint':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedIPListPrint.php');break;
    case 'ABBlockedIPMenu':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedIPMenu.php');break;
    case 'ABBlockedIPView':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedIPView.php');break;
    case 'ABBlockedIPViewPrint':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedIPViewPrint.php');break;
    case 'ABBlockedRangeAdd':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedRangeAdd.php');break;
    case 'ABBlockedRangeAddSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedRangeAddSave.php');break;
    case 'ABBlockedRangeClear':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedRangeClear.php');break;
    case 'ABBlockedRangeClearExpired':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedRangeClearExpired.php');break;
    case 'ABBlockedRangeClearSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedRangeClearSave.php');break;
    case 'ABBlockedRangeDelete':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedRangeDelete.php');break;
    case 'ABBlockedRangeDeleteSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedRangeDeleteSave.php');break;
    case 'ABBlockedRangeEdit':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedRangeEdit.php');break;
    case 'ABBlockedRangeEditSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedRangeEditSave.php');break;
    case 'ABBlockedRangeList':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedRangeList.php');break;
    case 'ABBlockedRangeListPrint':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedRangeListPrint.php');break;
    case 'ABBlockedRangeMenu':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedRangeMenu.php');break;
    case 'ABBlockedRangeOverlapCheck':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedRangeOverlapCheck.php');break;
    case 'ABBlockedRangeView':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedRangeView.php');break;
    case 'ABBlockedRangeViewPrint':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABBlockedRangeViewPrint.php');break;
    case 'ABCGIAuth':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABCGIAuth.php');break;
    case 'ABCGIBuild':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABCGIBuild.php');break;
    case 'ABConfig':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABConfig.php');break;
    case 'ABConfigAdmin':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABConfigAdmin.php');break;
    case 'ABConfigAuthor':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABConfigAuthor.php');break;
    case 'ABConfigClike':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABConfigClike.php');break;
    case 'ABConfigDefault':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABConfigDefault.php');break;
    case 'ABConfigFilter':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABConfigFilter.php');break;
    case 'ABConfigFlood':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABConfigFlood.php');break;
    case 'ABConfigHarvester':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABConfigHarvester.php');break;
    case 'ABConfigReferer':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABConfigReferer.php');break;
    case 'ABConfigRequest':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABConfigRequest.php');break;
    case 'ABConfigSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABConfigSave.php');break;
    case 'ABConfigScript':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABConfigScript.php');break;
    case 'ABConfigString':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABConfigString.php');break;
    case 'ABConfigUnion':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABConfigUnion.php');break;
    case 'ABConfigUpdate':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABConfigUpdate.php');break;
    case 'ABCountryList':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABCountryList.php');break;
    case 'ABDBMaintenance':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABDBMaintenance.php');break;
    case 'ABDBOptimize':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABDBOptimize.php');break;
    case 'ABDBRepair':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABDBRepair.php');break;
    case 'ABDBStructure':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABDBStructure.php');break;
    case 'ABExcludedAdd':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABExcludedAdd.php');break;
    case 'ABExcludedAddSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABExcludedAddSave.php');break;
    case 'ABExcludedClear':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABExcludedClear.php');break;
    case 'ABExcludedClearSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABExcludedClearSave.php');break;
    case 'ABExcludedDelete':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABExcludedDelete.php');break;
    case 'ABExcludedDeleteSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABExcludedDeleteSave.php');break;
    case 'ABExcludedEdit':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABExcludedEdit.php');break;
    case 'ABExcludedEditSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABExcludedEditSave.php');break;
    case 'ABExcludedList':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABExcludedList.php');break;
    case 'ABExcludedListPrint':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABExcludedListPrint.php');break;
    case 'ABExcludedMenu':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABExcludedMenu.php');break;
    case 'ABExcludedOverlapCheck':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABExcludedOverlapCheck.php');break;
    case 'ABExcludedView':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABExcludedView.php');break;
    case 'ABExcludedViewPrint':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABExcludedViewPrint.php');break;
    case 'ABHarvesterAdd':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABHarvesterAdd.php');break;
    case 'ABHarvesterAddSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABHarvesterAddSave.php');break;
    case 'ABHarvesterDelete':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABHarvesterDelete.php');break;
    case 'ABHarvesterDeleteSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABHarvesterDeleteSave.php');break;
    case 'ABHarvesterEdit':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABHarvesterEdit.php');break;
    case 'ABHarvesterEditSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABHarvesterEditSave.php');break;
    case 'ABHarvesterList':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABHarvesterList.php');break;
    case 'ABHarvesterListPrint':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABHarvesterListPrint.php');break;
    case 'ABHarvesterMenu':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABHarvesterMenu.php');break;
	case 'ABIpCheck':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABIpCheck.php');break;
    case 'ABIP2CountryAdd':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABIP2CountryAdd.php');break;
    case 'ABIP2CountryAddSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABIP2CountryAddSave.php');break;
    case 'ABIP2CountryDelete':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABIP2CountryDelete.php');break;
    case 'ABIP2CountryDeleteSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABIP2CountryDeleteSave.php');break;
    case 'ABIP2CountryEdit':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABIP2CountryEdit.php');break;
    case 'ABIP2CountryEditSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABIP2CountryEditSave.php');break;
    case 'ABIP2CountryList':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABIP2CountryList.php');break;
    case 'ABIP2CountryMenu':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABIP2CountryMenu.php');break;
    case 'ABIP2CountryOverlapCheck':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABIP2CountryOverlapCheck.php');break;
    case 'ABIP2CountryUpdateBlocked':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABIP2CountryUpdateBlocked.php');break;
    case 'ABIP2CountryUpdateBlockedRanges':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABIP2CountryUpdateBlockedRanges.php');break;
    case 'ABIP2CountryUpdateExcludedRanges':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABIP2CountryUpdateExcludedRanges.php');break;
    case 'ABIP2CountryUpdateProtectedRanges':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABIP2CountryUpdateProtectedRanges.php');break;
    case 'ABIP2CountryUpdateTracked':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABIP2CountryUpdateTracked.php');break;
    case 'ABLoadError':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABLoadError.php');break;
    case 'ABMain':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABMain.php');break;
    case 'ABMainSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABMainSave.php');break;
    case 'ABProtectedAdd':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABProtectedAdd.php');break;
    case 'ABProtectedAddSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABProtectedAddSave.php');break;
    case 'ABProtectedClear':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABProtectedClear.php');break;
    case 'ABProtectedClearSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABProtectedClearSave.php');break;
    case 'ABProtectedDelete':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABProtectedDelete.php');break;
    case 'ABProtectedDeleteSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABProtectedDeleteSave.php');break;
    case 'ABProtectedEdit':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABProtectedEdit.php');break;
    case 'ABProtectedEditSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABProtectedEditSave.php');break;
    case 'ABProtectedList':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABProtectedList.php');break;
    case 'ABProtectedListPrint':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABProtectedListPrint.php');break;
    case 'ABProtectedMenu':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABProtectedMenu.php');break;
    case 'ABProtectedOverlapCheck':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABProtectedOverlapCheck.php');break;
    case 'ABProtectedView':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABProtectedView.php');break;
    case 'ABProtectedViewPrint':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABProtectedViewPrint.php');break;
    case 'ABRefererAdd':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABRefererAdd.php');break;
    case 'ABRefererAddSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABRefererAddSave.php');break;
    case 'ABRefererDelete':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABRefererDelete.php');break;
    case 'ABRefererDeleteSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABRefererDeleteSave.php');break;
    case 'ABRefererEdit':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABRefererEdit.php');break;
    case 'ABRefererEditSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABRefererEditSave.php');break;
    case 'ABRefererList':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABRefererList.php');break;
    case 'ABRefererListPrint':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABRefererListPrint.php');break;
    case 'ABRefererMenu':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABRefererMenu.php');break;
    case 'ABSearch':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABSearch.php');break;
    case 'ABSearchIPPrint':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABSearchIPPrint.php');break;
    case 'ABSearchIPResults':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABSearchIPResults.php');break;
    case 'ABSearchRangePrint':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABSearchRangePrint.php');break;
    case 'ABSearchRangeResults':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABSearchRangeResults.php');break;
    case 'ABStringAdd':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABStringAdd.php');break;
    case 'ABStringAddSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABStringAddSave.php');break;
    case 'ABStringDelete':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABStringDelete.php');break;
    case 'ABStringDeleteSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABStringDeleteSave.php');break;
    case 'ABStringEdit':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABStringEdit.php');break;
    case 'ABStringEditSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABStringEditSave.php');break;
    case 'ABStringList':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABStringList.php');break;
    case 'ABStringListPrint':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABStringListPrint.php');break;
    case 'ABStringMenu':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABStringMenu.php');break;
    case 'ABTemplate':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTemplate.php');break;
    case 'ABTemplateSource':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTemplateSource.php');break;
    case 'ABTemplateView':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTemplateView.php');break;
    case 'ABTrackedAdd':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedAdd.php');break;
    case 'ABTrackedAddSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedAddSave.php');break;
    case 'ABTrackedAgentsList':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedAgentsList.php');break;
    case 'ABTrackedAgentsDelete':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedAgentsDelete.php');break;
    case 'ABTrackedAgentsIPs':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedAgentsIPs.php');break;
    case 'ABTrackedAgentsListAdd':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedAgentsListAdd.php');break;
    case 'ABTrackedAgentsListAddSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedAgentsListAddSave.php');break;
    case 'ABTrackedAgentsListPrint':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedAgentsListPrint.php');break;
    case 'ABTrackedAgentsPages':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedAgentsPages.php');break;
    case 'ABTrackedAgentsPagesPrint':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedAgentsPagesPrint.php');break;
    case 'ABTrackedClear':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedClear.php');break;
    case 'ABTrackedClearSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedClearSave.php');break;
    case 'ABTrackedDelete':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedDelete.php');break;
    case 'ABTrackedDeleteSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedDeleteSave.php');break;
    case 'ABTrackedList':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedList.php');break;
    case 'ABTrackedListPrint':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedListPrint.php');break;
    case 'ABTrackedMenu':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedMenu.php');break;
    case 'ABTrackedPages':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedPages.php');break;
    case 'ABTrackedPagesPrint':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedPagesPrint.php');break;
    case 'ABTrackedRefersList':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedRefersList.php');break;
    case 'ABTrackedRefersDelete':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedRefersDelete.php');break;
    case 'ABTrackedRefersIPs':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedRefersIPs.php');break;
    case 'ABTrackedRefersListAdd':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedRefersListAdd.php');break;
    case 'ABTrackedRefersListAddSave':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedRefersListAddSave.php');break;
    case 'ABTrackedRefersListPrint':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedRefersListPrint.php');break;
    case 'ABTrackedRefersPages':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedRefersPages.php');break;
    case 'ABTrackedRefersPagesPrint':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedRefersPagesPrint.php');break;
    case 'ABTrackedUsersList':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedUsersList.php');break;
    case 'ABTrackedUsersDelete':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedUsersDelete.php');break;
    case 'ABTrackedUsersIPs':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedUsersIPs.php');break;
    case 'ABTrackedUsersListPrint':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedUsersListPrint.php');break;
    case 'ABTrackedUsersPages':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedUsersPages.php');break;
    case 'ABTrackedUsersPagesPrint':include(NUKE_ADMIN_MODULE_DIR.'nukesentinel/ABTrackedUsersPagesPrint.php');break;
  }
} else {
    DisplayError('<strong>' . _ERROR . '</strong><br /><br />' . _NO_ADMIN_RIGHTS . '<strong>' . _AB_NUKESENTINEL . '</strong>');
}

?>