<?php
$glob = dirname(__FILE__)."/*.xml";
foreach (glob($glob) as $src_file) {
    $src_dir = dirname($src_file);
    $src_name = basename($src_file);
    $dst_name = "CAC_ED_" . mb_strtolower(substr($src_name, 7));
    // if ($src_name == $dst_name) continue;
    echo $src_name . " > " . $dst_name . "\n";
    // rename($src_file, $src_dir . '/' . $dst_name);
}


class Hurlus
{
  /** Home directory of project, absolute */
  static $home;
  
  public static function init()
  {
    self::$home = dirname(__FILE__).'/';
  }

  public static function readme()
  {
    include(dirname(dirname(__FILE__)).'/teinte/teidoc.php');
    $readme = "
# Delacroix, des lettres

Liens vers les fichiers XML/TEI. En cliquant, un texte devrait vous apparaître 
sans balises et proprement mis en page, avec une transformatoin XSLT à la volée
qui se fait dans le navigateur.

| De   | À    | Date | XML/TEI |
| :--- | :--- | ---: | ------: | 
";
    $glob = dirname(__FILE__)."/*.xml";
    $i = 1;
    $dom = new DOMDocument();
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput=true;
    $dom->substituteEntities=true;
    
    foreach (glob($glob) as $srcfile) {
      $name = pathinfo($srcfile,  PATHINFO_FILENAME);

      $dom->load($srcfile, LIBXML_NOENT | LIBXML_NONET | LIBXML_NSCLEAN | LIBXML_NOCDATA | LIBXML_NOWARNING);
      $xpath = new DOMXpath($dom);
      $xpath->registerNamespace('tei', "http://www.tei-c.org/ns/1.0");
      $de = "???";
      $nl = $xpath->query("//tei:correspAction[@type='sent']/tei:persName");
      foreach ($nl as $node) {
        $value = $node->getAttribute ('key');
        if (!$value) break;
        list($value) = explode("(", $value);
        $de = trim($value);
        break;
      }
      $date = "???";
      $nl = $xpath->query("//tei:correspAction[@type='sent']/tei:date");
      foreach ($nl as $node) {
        $value = $node->getAttribute ('when');
        if (!$value) break;
        $date = $value;
        break;
      }
      $a = "???";
      $nl = $xpath->query("//tei:correspAction[@type='received']/tei:persName");
      foreach ($nl as $node) {
        $value = $node->getAttribute ('key');
        if (!$value) break;
        list($value) = explode("(", $value);
        $a = trim($value);
        break;
      }

      // $readme .= "|$i.";
      $readme .= "|$de";
      $readme .= "|$a";
      $readme .= "|$date";
      $readme .= "|$name";
      $readme .= "|\n";
      $i++;
    }
    return $readme;
  }
}
