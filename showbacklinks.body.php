<?php 

class ShowBackLinksHooks {

    public static function onSkinAfterContent( &$data, Skin $skin = null ) {
        global $wgOut, $wgTitle;
        $tMain = Title::newFromText(wfMessage("mainpage")->text());
        $backlinks = array();
        foreach ($wgTitle->getLinksTo() as $t) {
            if ($t == $wgTitle || $t->getText() == $tMain || !$t->exists() || ($t->getNamespace() !== NS_MAIN) || ($t->isRedirect())) {
                continue;
            }
            $backlinks[] = $t;
        }
        if (count($backlinks) > 0) {        
            $text = "== " . wfMessage("whatlinkshere")->text() . " ==\n";
            foreach ($backlinks as $t) {
                $text .= "* [[".$t->getText()."]]\n";
            }         
            $data = $wgOut->parse( $text );
        }
        return true;
    }

}
