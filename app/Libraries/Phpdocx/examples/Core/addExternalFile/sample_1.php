<?php

require_once '../../../classes/CreateDocx.inc';

$docx = new CreateDocx();

$docx->addText('We are going to insert now a full Word document. Beware that this method is not compatible with legacy versions of Word running the docx compatibility pack.');
$docx->addExternalFile(array('src' => '../../files/Text.docx'));
$docx->addText('A new paragraph.');


$docx->createDocx('example_addDOCX');