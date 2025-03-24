<?php
/**
 * Install hook
 *
 * @return boolean
 */
function plugin_descriptionCompleter_install()
{
   return true;
}

/**
 * Uninstall hook
 *
 * @return boolean
 */
function plugin_descriptionCompleter_uninstall()
{
   return true;
}

/**
 * Function to replace object content
 *
 * @return void
 */
function replace_description_content(CommonDBTM $item)
{
   $regexPatterns = [
      ["pattern" => "/(\s|[rpmi]>)(t_0*(\d+))/i", "substitute" => '$1<a href="/front/ticket.form.php?id=$3" target="_blank" rel="noopener">$2</a>'],
      ["pattern" => "/(\s|[rpmi]>)(ticket\s*0*(\d+))/i", "substitute" => '$1<a href="/front/ticket.form.php?id=$3" target="_blank" rel="noopener">$2</a>'],
      ["pattern" => "/(\s|[rpmi]>)(REQ0*(\d+))/i", "substitute" => '$1<a href="/front/ticket.form.php?id=$3" target="_blank" rel="noopener">$2</a>'],
      ["pattern" => "/(\s|[rpmi]>)(REC0*(\d+))/i", "substitute" => '$1<a href="/front/ticket.form.php?id=$3" target="_blank" rel="noopener">$2</a>'],
      ["pattern" => "/(\s|[rpmi]>)(PO0*(\d+))/i", "substitute" => '$1<a href="/front/ticket.form.php?id=$3" target="_blank" rel="noopener">$2</a>'],
   ];

   $decodedContent = html_entity_decode($item->input["content"]);

   foreach ($regexPatterns as ["pattern" => $pattern, "substitute" => $substitute]) {
      $decodedContent = preg_replace(
         $pattern,
         $substitute,
         $decodedContent
      );
   }

   $item->input['content'] = htmlentities(
      $decodedContent,
      ENT_NOQUOTES,
      'utf-8'
   );
}