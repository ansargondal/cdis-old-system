<?php

namespace App\Http\Controllers;

use App\Libraries\Phpdocx\PhpDocX;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

class DocController extends Controller
{
    public function index()
    {
        $docX = (new PhpDocX())->docX('template.docx');

        $docX->replacePlaceholderImage('IMAGE', 'image.png');
        $docX->replacePlaceholderImage('SIGNATURE', 'signature.png');
        $variables['date'] = date("d-m-Y");
        $variables['company'] = 'DevDimensions';
        $variables['applicant'] = 'Ansar Gondal';
        $opt = array('parseLineBreaks' => true);
        $docX->replaceVariableByText($variables, $opt);

        $docX->createDocx('new-file.docx');
        return 'done baby';
//        $phpWord = new PhpWord();

        $templateProcessor = new TemplateProcessor('template.docx');

        $templateProcessor->setValue('date', date("d-m-Y"));
//        $templateProcessor->setValue('name', 'John Doe');


        $newImage = file_get_contents('image.png');
//        $templateProcessor->setImageValue('placeholder.png', $newImage);

        $fileindocX = 'placeholder.png';

        $templateProcessor->zip()->AddFromString('template.docx', $newImage);

//        $imageStyle = array(
//            'width' => 40,
//            'height' => 40,
//            'wrappingStyle' => 'square',
//            'positioning' => 'absolute',
//            'posHorizontalRel' => 'margin',
//            'posVerticalRel' => 'line',
//        );
//        $templateProcessor->addImage('image.png', $imageStyle);
//        $textrun->addText($lipsumText);
//        $templateProcessor->setValue(
//            ['city', 'street'],
//            ['Sunnydale, 54321 Wisconsin', '123 International Lane']);

        $templateProcessor->saveAs('new-file.docx');

        return 'done';

// Creating the new document...
        $phpWord = new PhpWord();


// Adding an empty Section to the document...
        $section = $phpWord->addSection();
// Adding Text element to the Section having font styled by default...
        $section->addText(
            '"Learn from yesterday, live for today, hope for tomorrow. '
            . 'The important thing is not to stop questioning." '
            . '(Albert Einstein)'
        );

        /*
         * Note: it's possible to customize font style of the Text element you add in three ways:
         * - inline;
         * - using named font style (new font style object will be implicitly created);
         * - using explicitly created font style object.
         */

// Adding Text element with font customized inline...
        $section->addText(
            '"Great achievement is usually born of great sacrifice, '
            . 'and is never the result of selfishness." '
            . '(Napoleon Hill)',
            array('name' => 'Tahoma', 'size' => 10)
        );

// Adding Text element with font customized using named font style...
        $fontStyleName = 'oneUserDefinedStyle';
        $phpWord->addFontStyle(
            $fontStyleName,
            array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true)
        );
        $section->addText(
            '"The greatest accomplishment is not in never falling, '
            . 'but in rising again after you fall." '
            . '(Vince Lombardi)',
            $fontStyleName
        );

// Adding Text element with font customized using explicitly created font style object...
        $fontStyle = new Font();
        $fontStyle->setBold(true);
        $fontStyle->setName('Tahoma');
        $fontStyle->setSize(13);
        $myTextElement = $section->addText('"Believe you can and you\'re halfway there." (Theodor Roosevelt)');
        $myTextElement->setFontStyle($fontStyle);

// Saving the document as OOXML file...
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('helloWorld.docx');

// Saving the document as ODF file...
//        $objWriter = IOFactory::createWriter($phpWord, 'ODText');
//        $objWriter->save('helloWorld.odt');

//// Saving the document as HTML file...
//        $objWriter = IOFactory::createWriter($phpWord, 'HTML');
//        $objWriter->save('helloWorld.html');
//        return 'doc';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
