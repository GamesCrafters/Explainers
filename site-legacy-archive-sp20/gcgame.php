<?php

class GCGame
{
	public $root = "";
    public $name = "";
    public $code = "";
    public $history = "";
    public $board = "";
    public $pieces = "";
    public $tomove = "";
    public $towin = "";
    public $rules = "";
    
    // ASSOC: name, description
    public $strategies = array();
    
    // ASSOC: name, description
    public $variants = array();
    
    public $pictures = array();
    public $alternates = array();
    public $references = array();
    public $links = array();
    public $gamescrafters = array();
    
    public function __construct($filename = null, $root="")
    {
        $this->root = $root;
        if($filename != null)
        {
            $doc = new DOMDocument();
            $doc->load("{$root}games/$filename.xml");
            $game = $doc->getElementsByTagName("game")->item(0);
            $this->name = $game->getElementsByTagName("name")->item(0)->nodeValue;
            $this->code = $game->getElementsByTagName("code")->item(0)->nodeValue;
            $this->history = $game->getElementsByTagName("history")->item(0)->nodeValue;
            $this->board = $game->getElementsByTagName("board")->item(0)->nodeValue;
            $this->pieces = $game->getElementsByTagName("pieces")->item(0)->nodeValue;
            $this->tomove = $game->getElementsByTagName("tomove")->item(0)->nodeValue;
            $this->towin = $game->getElementsByTagName("towin")->item(0)->nodeValue;
            $this->rules = $game->getElementsByTagName("rules")->item(0)->nodeValue;
            
            $xml_strategies = $game->getElementsByTagName("strategy");
            foreach($xml_strategies as $strategy)
            {
                $this->strategies[] = array("name"=>$strategy->getElementsByTagName("name")->item(0)->nodeValue,
                                              "description"=>$strategy->getElementsByTagName("description")->item(0)->nodeValue);
            }
            
            $xml_variants = $game->getElementsByTagName("variant");
            foreach($xml_variants as $variant)
            {
                $this->variants[] = array("name"=>$variant->getElementsByTagName("name")->item(0)->nodeValue,
                                            "description"=>$variant->getElementsByTagName("description")->item(0)->nodeValue);
            }
            
            $xml_alternates = $game->getElementsByTagName("alternate");
            foreach($xml_alternates as $alternate)
                $this->alternates[] = $alternate->nodeValue;
            
            $xml_pictures = $game->getElementsByTagName("picture");
            foreach($xml_pictures as $picture)
                $this->pictures[] = $picture->nodeValue;
            
            $xml_references = $game->getElementsByTagName("reference");
            foreach($xml_references as $reference)
                $this->references[] = htmlspecialchars($reference->nodeValue, ENT_NOQUOTES);
                
            $xml_links = $game->getElementsByTagName("link");
            foreach($xml_links as $link)
                $this->links[] = array("url"=>$link->getElementsByTagName("url")->item(0)->nodeValue,
                                            "description"=>$link->getElementsByTagName("description")->item(0)->nodeValue);
                
            $xml_gamescrafters = $game->getElementsByTagName("gamescrafter");
            foreach($xml_gamescrafters as $gamescrafter)
                $this->gamescrafters[] = $gamescrafter->nodeValue;
        }
    }
    
    public function save()
    {
        $doc = new DOMDocument('1.0', 'UTF-8');
        $doc->formatOutput = true;
        $root = $doc->createElement("game");
        $root = $doc->appendChild($root);
        
        $name = $root->appendChild($doc->createElement("name"));
        $name->appendChild($doc->createTextNode($this->name));
        
        $code = $root->appendChild($doc->createElement("code"));
        $code->appendChild($doc->createTextNode($this->code));
        
        $history = $root->appendChild($doc->createElement("history"));
        $history->appendChild($doc->createTextNode($this->history));
        
        $board = $root->appendChild($doc->createElement("board"));
        $board->appendChild($doc->createTextNode($this->board));
        
        $pieces = $root->appendChild($doc->createElement("pieces"));
        $pieces->appendChild($doc->createTextNode($this->pieces));
        
        $tomove = $root->appendChild($doc->createElement("tomove"));
        $tomove->appendChild($doc->createTextNode($this->tomove));
        
        $towin = $root->appendChild($doc->createElement("towin"));
        $towin->appendChild($doc->createTextNode($this->towin));
        
        $rules = $root->appendChild($doc->createElement("rules"));
        $rules->appendChild($doc->createTextNode($this->rules));
        
        $strategies = $root->appendChild($doc->createElement("strategies"));
        foreach($this->strategies as $s)
        {
            $strategy = $doc->createElement("strategy");
            
            $strategyName = $strategy->appendChild($doc->createElement("name"));
            $strategyName->appendChild($doc->createTextNode($s['name']));
            
            $strategyDescription = $strategy->appendChild($doc->createElement("description"));
            $strategyDescription->appendChild($doc->createTextNode($s['description']));
            
            $strategies->appendChild($strategy);
        }
        
        $variants = $root->appendChild($doc->createElement("variants"));
        foreach($this->variants as $v)
        {
            $variant = $doc->createElement("variant");
            
            $variantName = $variant->appendChild($doc->createElement("name"));
            $variantName->appendChild($doc->createTextNode($v['name']));
            
            $variantDescription = $variant->appendChild($doc->createElement("description"));
            $variantDescription->appendChild($doc->createTextNode($v['description']));
            
            $variants->appendChild($variant);
        }
        
        $alternates = $root->appendChild($doc->createElement("alternates"));
        foreach($this->alternates as $a)
        {
            $alternate = $doc->createElement("alternate");
            $alternate->appendChild($doc->createTextNode($a));
            $alternates->appendChild($alternate);
        }
        
        $pictures = $root->appendChild($doc->createElement("pictures"));
        foreach($this->pictures as $p)
        {
            $picture = $doc->createElement("picture");
            $picture->appendChild($doc->createTextNode($p));
            $pictures->appendChild($picture);
        }
        
        $references = $root->appendChild($doc->createElement("references"));
        foreach($this->references as $r)
        {
            $reference = $doc->createElement("reference");
            $reference->appendChild($doc->createTextNode($r));
            $references->appendChild($reference);
        }
        
        $links = $root->appendChild($doc->createElement("links"));
        foreach($this->links as $l)
        {
            $link = $doc->createElement("link");
            
            $linkURL = $link->appendChild($doc->createElement("url"));
            $linkURL->appendChild($doc->createTextNode($l['url']));
            
            $linkDescription = $link->appendChild($doc->createElement("description"));
            $linkDescription->appendChild($doc->createTextNode($l['description']));
            
            $links->appendChild($link);
        }
        
        $gamescrafters = $root->appendChild($doc->createElement("gamescrafters"));
        foreach($this->gamescrafters as $g)
        {
            $gamescrafter = $doc->createElement("gamescrafter");
            $gamescrafter->appendChild($doc->createTextNode($g));
            $gamescrafters->appendChild($gamescrafter);
        }
        
        $doc->save("{$this->root}games/".$this->code.".xml");
    }
}
?>