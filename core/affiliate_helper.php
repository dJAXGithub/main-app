<?php
class affiliate_helper {
	public static function LoadAffiliateIfPresent() {
		if ($_GET["affiliate"]) {
			$affiliate = new affiliate();
			$affiliate = $affiliate->GetSingle(array(array("slug", "=", $_GET["affiliate"]), array("active", "=", 1)));
			if ($affiliate->affiliateId) {
				session_manager::Set('affiliate', serialize($affiliate));
				session_manager::Remove('previous_affiliate');
			}
		}
	}
	public static function IsAffiliateMode() {
		return session_manager::Get('affiliate');
	}
	public static function Affiliate() {
		return unserialize(session_manager::Get('affiliate'));
	}
	public static function RemoveAffiliateMode() {
		if (session_manager::Get('affiliate')) {
			session_manager::Set('previous_affiliate', session_manager::Get('affiliate'));
			session_manager::Remove('affiliate');
		}
	}
	public static function PreviousAffiliate() {
		if (session_manager::Get('previous_affiliate')) return unserialize(session_manager::Get('previous_affiliate'));
		else return null;
	}
}
?>