<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "userinfoinfo.php" ?>
<?php include "userfn7.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Create page object
$userinfo_edit = new cuserinfo_edit();
$Page =& $userinfo_edit;

// Page init
$userinfo_edit->Page_Init();

// Page main
$userinfo_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var userinfo_edit = new ew_Page("userinfo_edit");

// page properties
userinfo_edit.PageID = "edit"; // page ID
userinfo_edit.FormID = "fuserinfoedit"; // form ID
var EW_PAGE_ID = userinfo_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
userinfo_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_zemail"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($userinfo->zemail->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_firstname"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($userinfo->firstname->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_lastname"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($userinfo->lastname->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_password"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($userinfo->password->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_facebook"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($userinfo->facebook->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_block"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($userinfo->block->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
userinfo_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
userinfo_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
userinfo_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $userinfo->TableCaption() ?><br><br>
<a href="<?php echo $userinfo->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$userinfo_edit->ShowMessage();
?>
<form name="fuserinfoedit" id="fuserinfoedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return userinfo_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="userinfo">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($userinfo->zuserid->Visible) { // userid ?>
	<tr<?php echo $userinfo->zuserid->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $userinfo->zuserid->FldCaption() ?></td>
		<td<?php echo $userinfo->zuserid->CellAttributes() ?>><span id="el_zuserid">
<div<?php echo $userinfo->zuserid->ViewAttributes() ?>><?php echo $userinfo->zuserid->EditValue ?></div><input type="hidden" name="x_zuserid" id="x_zuserid" value="<?php echo ew_HtmlEncode($userinfo->zuserid->CurrentValue) ?>">
</span><?php echo $userinfo->zuserid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($userinfo->zemail->Visible) { // email ?>
	<tr<?php echo $userinfo->zemail->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $userinfo->zemail->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $userinfo->zemail->CellAttributes() ?>><span id="el_zemail">
<input type="text" name="x_zemail" id="x_zemail" title="<?php echo $userinfo->zemail->FldTitle() ?>" size="30" maxlength="80" value="<?php echo $userinfo->zemail->EditValue ?>"<?php echo $userinfo->zemail->EditAttributes() ?>>
</span><?php echo $userinfo->zemail->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($userinfo->firstname->Visible) { // firstname ?>
	<tr<?php echo $userinfo->firstname->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $userinfo->firstname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $userinfo->firstname->CellAttributes() ?>><span id="el_firstname">
<input type="text" name="x_firstname" id="x_firstname" title="<?php echo $userinfo->firstname->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $userinfo->firstname->EditValue ?>"<?php echo $userinfo->firstname->EditAttributes() ?>>
</span><?php echo $userinfo->firstname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($userinfo->lastname->Visible) { // lastname ?>
	<tr<?php echo $userinfo->lastname->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $userinfo->lastname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $userinfo->lastname->CellAttributes() ?>><span id="el_lastname">
<input type="text" name="x_lastname" id="x_lastname" title="<?php echo $userinfo->lastname->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $userinfo->lastname->EditValue ?>"<?php echo $userinfo->lastname->EditAttributes() ?>>
</span><?php echo $userinfo->lastname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($userinfo->password->Visible) { // password ?>
	<tr<?php echo $userinfo->password->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $userinfo->password->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $userinfo->password->CellAttributes() ?>><span id="el_password">
<input type="text" name="x_password" id="x_password" title="<?php echo $userinfo->password->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $userinfo->password->EditValue ?>"<?php echo $userinfo->password->EditAttributes() ?>>
</span><?php echo $userinfo->password->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($userinfo->facebook->Visible) { // facebook ?>
	<tr<?php echo $userinfo->facebook->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $userinfo->facebook->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $userinfo->facebook->CellAttributes() ?>><span id="el_facebook">
<input type="text" name="x_facebook" id="x_facebook" title="<?php echo $userinfo->facebook->FldTitle() ?>" size="30" value="<?php echo $userinfo->facebook->EditValue ?>"<?php echo $userinfo->facebook->EditAttributes() ?>>
</span><?php echo $userinfo->facebook->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($userinfo->block->Visible) { // block ?>
	<tr<?php echo $userinfo->block->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $userinfo->block->FldCaption() ?></td>
		<td<?php echo $userinfo->block->CellAttributes() ?>><span id="el_block">
<input type="text" name="x_block" id="x_block" title="<?php echo $userinfo->block->FldTitle() ?>" size="30" value="<?php echo $userinfo->block->EditValue ?>"<?php echo $userinfo->block->EditAttributes() ?>>
</span><?php echo $userinfo->block->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$userinfo_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cuserinfo_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'userinfo';

	// Page object name
	var $PageObjName = 'userinfo_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $userinfo;
		if ($userinfo->UseTokenInUrl) $PageUrl .= "t=" . $userinfo->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage);
		if ($sMessage <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $sMessage . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $userinfo;
		if ($userinfo->UseTokenInUrl) {
			if ($objForm)
				return ($userinfo->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($userinfo->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cuserinfo_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (userinfo)
		$GLOBALS["userinfo"] = new cuserinfo();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'userinfo', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $userinfo;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Create form object
		$objForm = new cFormObj();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		$this->Page_Redirecting($url);
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $sDbMasterFilter;
	var $sDbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $userinfo;

		// Load key from QueryString
		if (@$_GET["zuserid"] <> "")
			$userinfo->zuserid->setQueryStringValue($_GET["zuserid"]);
		if (@$_POST["a_edit"] <> "") {
			$userinfo->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$userinfo->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$userinfo->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$userinfo->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($userinfo->zuserid->CurrentValue == "")
			$this->Page_Terminate("userinfolist.php"); // Invalid key, return to list
		switch ($userinfo->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("userinfolist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$userinfo->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $userinfo->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$userinfo->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$userinfo->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $userinfo;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $userinfo;
		$userinfo->zuserid->setFormValue($objForm->GetValue("x_zuserid"));
		$userinfo->zemail->setFormValue($objForm->GetValue("x_zemail"));
		$userinfo->firstname->setFormValue($objForm->GetValue("x_firstname"));
		$userinfo->lastname->setFormValue($objForm->GetValue("x_lastname"));
		$userinfo->password->setFormValue($objForm->GetValue("x_password"));
		$userinfo->facebook->setFormValue($objForm->GetValue("x_facebook"));
		$userinfo->logintime->setFormValue($objForm->GetValue("x_logintime"));
		$userinfo->logintime->CurrentValue = ew_UnFormatDateTime($userinfo->logintime->CurrentValue, 5);
		$userinfo->block->setFormValue($objForm->GetValue("x_block"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $userinfo;
		$this->LoadRow();
		$userinfo->zuserid->CurrentValue = $userinfo->zuserid->FormValue;
		$userinfo->zemail->CurrentValue = $userinfo->zemail->FormValue;
		$userinfo->firstname->CurrentValue = $userinfo->firstname->FormValue;
		$userinfo->lastname->CurrentValue = $userinfo->lastname->FormValue;
		$userinfo->password->CurrentValue = $userinfo->password->FormValue;
		$userinfo->facebook->CurrentValue = $userinfo->facebook->FormValue;
		$userinfo->logintime->CurrentValue = $userinfo->logintime->FormValue;
		$userinfo->logintime->CurrentValue = ew_UnFormatDateTime($userinfo->logintime->CurrentValue, 5);
		$userinfo->block->CurrentValue = $userinfo->block->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $userinfo;
		$sFilter = $userinfo->KeyFilter();

		// Call Row Selecting event
		$userinfo->Row_Selecting($sFilter);

		// Load SQL based on filter
		$userinfo->CurrentFilter = $sFilter;
		$sSql = $userinfo->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$userinfo->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $userinfo;
		$userinfo->zuserid->setDbValue($rs->fields('userid'));
		$userinfo->zemail->setDbValue($rs->fields('email'));
		$userinfo->firstname->setDbValue($rs->fields('firstname'));
		$userinfo->lastname->setDbValue($rs->fields('lastname'));
		$userinfo->password->setDbValue($rs->fields('password'));
		$userinfo->facebook->setDbValue($rs->fields('facebook'));
		$userinfo->logintime->setDbValue($rs->fields('logintime'));
		$userinfo->block->setDbValue($rs->fields('block'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $userinfo;

		// Initialize URLs
		// Call Row_Rendering event

		$userinfo->Row_Rendering();

		// Common render codes for all row types
		// userid

		$userinfo->zuserid->CellCssStyle = ""; $userinfo->zuserid->CellCssClass = "";
		$userinfo->zuserid->CellAttrs = array(); $userinfo->zuserid->ViewAttrs = array(); $userinfo->zuserid->EditAttrs = array();

		// email
		$userinfo->zemail->CellCssStyle = ""; $userinfo->zemail->CellCssClass = "";
		$userinfo->zemail->CellAttrs = array(); $userinfo->zemail->ViewAttrs = array(); $userinfo->zemail->EditAttrs = array();

		// firstname
		$userinfo->firstname->CellCssStyle = ""; $userinfo->firstname->CellCssClass = "";
		$userinfo->firstname->CellAttrs = array(); $userinfo->firstname->ViewAttrs = array(); $userinfo->firstname->EditAttrs = array();

		// lastname
		$userinfo->lastname->CellCssStyle = ""; $userinfo->lastname->CellCssClass = "";
		$userinfo->lastname->CellAttrs = array(); $userinfo->lastname->ViewAttrs = array(); $userinfo->lastname->EditAttrs = array();

		// password
		$userinfo->password->CellCssStyle = ""; $userinfo->password->CellCssClass = "";
		$userinfo->password->CellAttrs = array(); $userinfo->password->ViewAttrs = array(); $userinfo->password->EditAttrs = array();

		// facebook
		$userinfo->facebook->CellCssStyle = ""; $userinfo->facebook->CellCssClass = "";
		$userinfo->facebook->CellAttrs = array(); $userinfo->facebook->ViewAttrs = array(); $userinfo->facebook->EditAttrs = array();

		// logintime
		$userinfo->logintime->CellCssStyle = ""; $userinfo->logintime->CellCssClass = "";
		$userinfo->logintime->CellAttrs = array(); $userinfo->logintime->ViewAttrs = array(); $userinfo->logintime->EditAttrs = array();

		// block
		$userinfo->block->CellCssStyle = ""; $userinfo->block->CellCssClass = "";
		$userinfo->block->CellAttrs = array(); $userinfo->block->ViewAttrs = array(); $userinfo->block->EditAttrs = array();
		if ($userinfo->RowType == EW_ROWTYPE_VIEW) { // View row

			// userid
			$userinfo->zuserid->ViewValue = $userinfo->zuserid->CurrentValue;
			$userinfo->zuserid->CssStyle = "";
			$userinfo->zuserid->CssClass = "";
			$userinfo->zuserid->ViewCustomAttributes = "";

			// email
			$userinfo->zemail->ViewValue = $userinfo->zemail->CurrentValue;
			$userinfo->zemail->CssStyle = "";
			$userinfo->zemail->CssClass = "";
			$userinfo->zemail->ViewCustomAttributes = "";

			// firstname
			$userinfo->firstname->ViewValue = $userinfo->firstname->CurrentValue;
			$userinfo->firstname->CssStyle = "";
			$userinfo->firstname->CssClass = "";
			$userinfo->firstname->ViewCustomAttributes = "";

			// lastname
			$userinfo->lastname->ViewValue = $userinfo->lastname->CurrentValue;
			$userinfo->lastname->CssStyle = "";
			$userinfo->lastname->CssClass = "";
			$userinfo->lastname->ViewCustomAttributes = "";

			// password
			$userinfo->password->ViewValue = $userinfo->password->CurrentValue;
			$userinfo->password->CssStyle = "";
			$userinfo->password->CssClass = "";
			$userinfo->password->ViewCustomAttributes = "";

			// facebook
			$userinfo->facebook->ViewValue = $userinfo->facebook->CurrentValue;
			$userinfo->facebook->CssStyle = "";
			$userinfo->facebook->CssClass = "";
			$userinfo->facebook->ViewCustomAttributes = "";

			// logintime
			$userinfo->logintime->ViewValue = $userinfo->logintime->CurrentValue;
			$userinfo->logintime->ViewValue = ew_FormatDateTime($userinfo->logintime->ViewValue, 5);
			$userinfo->logintime->CssStyle = "";
			$userinfo->logintime->CssClass = "";
			$userinfo->logintime->ViewCustomAttributes = "";

			// block
			$userinfo->block->ViewValue = $userinfo->block->CurrentValue;
			$userinfo->block->CssStyle = "";
			$userinfo->block->CssClass = "";
			$userinfo->block->ViewCustomAttributes = "";

			// userid
			$userinfo->zuserid->HrefValue = "";
			$userinfo->zuserid->TooltipValue = "";

			// email
			$userinfo->zemail->HrefValue = "";
			$userinfo->zemail->TooltipValue = "";

			// firstname
			$userinfo->firstname->HrefValue = "";
			$userinfo->firstname->TooltipValue = "";

			// lastname
			$userinfo->lastname->HrefValue = "";
			$userinfo->lastname->TooltipValue = "";

			// password
			$userinfo->password->HrefValue = "";
			$userinfo->password->TooltipValue = "";

			// facebook
			$userinfo->facebook->HrefValue = "";
			$userinfo->facebook->TooltipValue = "";

			// logintime
			$userinfo->logintime->HrefValue = "";
			$userinfo->logintime->TooltipValue = "";

			// block
			$userinfo->block->HrefValue = "";
			$userinfo->block->TooltipValue = "";
		} elseif ($userinfo->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// userid
			$userinfo->zuserid->EditCustomAttributes = "";
			$userinfo->zuserid->EditValue = $userinfo->zuserid->CurrentValue;
			$userinfo->zuserid->CssStyle = "";
			$userinfo->zuserid->CssClass = "";
			$userinfo->zuserid->ViewCustomAttributes = "";

			// email
			$userinfo->zemail->EditCustomAttributes = "";
			$userinfo->zemail->EditValue = ew_HtmlEncode($userinfo->zemail->CurrentValue);

			// firstname
			$userinfo->firstname->EditCustomAttributes = "";
			$userinfo->firstname->EditValue = ew_HtmlEncode($userinfo->firstname->CurrentValue);

			// lastname
			$userinfo->lastname->EditCustomAttributes = "";
			$userinfo->lastname->EditValue = ew_HtmlEncode($userinfo->lastname->CurrentValue);

			// password
			$userinfo->password->EditCustomAttributes = "";
			$userinfo->password->EditValue = ew_HtmlEncode($userinfo->password->CurrentValue);

			// facebook
			$userinfo->facebook->EditCustomAttributes = "";
			$userinfo->facebook->EditValue = ew_HtmlEncode($userinfo->facebook->CurrentValue);

			// logintime
			// block

			$userinfo->block->EditCustomAttributes = "";
			$userinfo->block->EditValue = ew_HtmlEncode($userinfo->block->CurrentValue);

			// Edit refer script
			// userid

			$userinfo->zuserid->HrefValue = "";

			// email
			$userinfo->zemail->HrefValue = "";

			// firstname
			$userinfo->firstname->HrefValue = "";

			// lastname
			$userinfo->lastname->HrefValue = "";

			// password
			$userinfo->password->HrefValue = "";

			// facebook
			$userinfo->facebook->HrefValue = "";

			// logintime
			$userinfo->logintime->HrefValue = "";

			// block
			$userinfo->block->HrefValue = "";
		}

		// Call Row Rendered event
		if ($userinfo->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$userinfo->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $userinfo;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($userinfo->zemail->FormValue) && $userinfo->zemail->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $userinfo->zemail->FldCaption();
		}
		if (!is_null($userinfo->firstname->FormValue) && $userinfo->firstname->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $userinfo->firstname->FldCaption();
		}
		if (!is_null($userinfo->lastname->FormValue) && $userinfo->lastname->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $userinfo->lastname->FldCaption();
		}
		if (!is_null($userinfo->password->FormValue) && $userinfo->password->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $userinfo->password->FldCaption();
		}
		if (!ew_CheckInteger($userinfo->facebook->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $userinfo->facebook->FldErrMsg();
		}
		if (!ew_CheckInteger($userinfo->block->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $userinfo->block->FldErrMsg();
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $userinfo;
		$sFilter = $userinfo->KeyFilter();
		$userinfo->CurrentFilter = $sFilter;
		$sSql = $userinfo->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// email
			$userinfo->zemail->SetDbValueDef($rsnew, $userinfo->zemail->CurrentValue, "", FALSE);

			// firstname
			$userinfo->firstname->SetDbValueDef($rsnew, $userinfo->firstname->CurrentValue, "", FALSE);

			// lastname
			$userinfo->lastname->SetDbValueDef($rsnew, $userinfo->lastname->CurrentValue, "", FALSE);

			// password
			$userinfo->password->SetDbValueDef($rsnew, $userinfo->password->CurrentValue, "", FALSE);

			// facebook
			$userinfo->facebook->SetDbValueDef($rsnew, $userinfo->facebook->CurrentValue, 0, FALSE);

			// logintime
			$userinfo->logintime->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
			$rsnew['logintime'] =& $userinfo->logintime->DbValue;

			// block
			$userinfo->block->SetDbValueDef($rsnew, $userinfo->block->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $userinfo->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($userinfo->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($userinfo->CancelMessage <> "") {
					$this->setMessage($userinfo->CancelMessage);
					$userinfo->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$userinfo->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	function Message_Showing(&$msg) {

		// Example:
		//$msg = "your new message";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
