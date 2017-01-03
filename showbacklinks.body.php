<?php 

class ShowBackLinksHooks {

    public static function onSkinAfterContent( &$data, Skin $skin = null ) {
        global $wgOut, $wgTitle;
        $tMain = Title::newFromText(wfMessage("mainpage")->text());
        $linksTitle = "== " . wfMessage("whatlinkshere")->text() . " ==\n";
        $text = "";
        foreach ($wgTitle->getLinksTo() as $t) {
            if ($t == $wgTitle || $t->getText() == $tMain || !$t->exists() || ($t->getNamespace() !== NS_MAIN) ) {
                continue;
            }
            if ($t->isRedirect()) {
                $text .= "* [[".$t->getText()."]] (redirect)\n";
                foreach ($t->getLinksTo() as $st) {
                    if ($st == $wgTitle || $st->getText() == $tMain || !$st->exists() || ($st->getNamespace() !== NS_MAIN) || ($st->isRedirect())) {
                        continue;
                    }
                    $text .= "** [[".$st->getText()."]]\n";
                }
                continue;
            }
            $text .= "* [[".$t->getText()."]]\n";
        }
        if (strlen($text) == 0) {
            $text = "No backlinks for this article.";
        }
        $data = $wgOut->parse( $linksTitle . $text );
        return true;
    }

}
