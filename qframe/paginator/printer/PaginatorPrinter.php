<?php

/**
 * Obtiene la representación visual del paginador.
 * 
 * @package qframe
 * 
 * @subpackage paginator
 * 
 * @author qinteractiva
 *
 */
class Library_Qframe_Paginator_Printer_PaginatorPrinter extends Library_Qframe_Printer_BasePrinter
{
	/**
	 * Devuelve una cadena de texto con la salida en pantalla por
	 * defecto del paginador, compuesta por los controles de navegación.
	 * 
	 * @return string
	 * 
	 */
	public function standardPrint()
	{
		$paginationHelper = self::getHelperData($this->getElement());
		
		return Library_Qframe_File_FileUtil::getFileContent($this->getElement()->getTemplate(),
															array('helper' => $paginationHelper,
																  'paginator' => $this->getElement()));
	}
	
	private function getHelperData(Library_Qframe_Paginator_Paginator $paginator)
	{
		$paginatorHelper = new Library_Qframe_Paginator_Helper_PaginatorHelper();
		
		$request = Library_Qframe_Manage_ResourceManager::getRequestData();
		
		$request->setParams(array());
		
		$pagesNumber = $paginator->getPagesNumber();
		$visiblePages = $paginator->getVisiblePages();
		$currentPage = $paginator->getCurrentPage();
		
		$printedPages = 1;
                
                $middle = floor($visiblePages / 2);
                
                if ($visiblePages > $pagesNumber)
                {
                    $visiblePages = $pagesNumber;
                }
                
                if ($currentPage == 1)
                {
                    $initLeft = 0;
                    $endLeft = 0;
                    
                    $initRight = $currentPage +1;
                    $endRight = $visiblePages;
                    if ($visiblePages > $pagesNumber)
                    {
                        $endRight = $pagesNumber;
                    }
                }
                else
                {
                    if ($currentPage == $pagesNumber)
                    {                       
                        $initLeft = $currentPage - $visiblePages + 1;
                        $endLeft = $currentPage;
                        if ($initLeft < 1)
                        {
                            $initLeft = 1;
                        }
                        
                        $initRight = $pagesNumber + 1;
                        $endRight = $pagesNumber;
                    }
                    else
                    {
                        if ($currentPage - $middle < 1)
                        {
                            $initLeft = 1;
                            $endLeft = $currentPage;
                            
                            $initRight = $currentPage +1;
                            $endRight = $visiblePages - $currentPage + $middle;
                        }
                        else
                        {
                            if ($currentPage + $middle > $pagesNumber)
                            {
                                $dif = $pagesNumber - $currentPage;
                                $initLeft = $currentPage - $middle - $dif;
                                $endLeft = $currentPage ;

                                $initRight = $currentPage +1;
                                $endRight = $pagesNumber;
                            }
                            else
                            {
                                $initLeft = $currentPage - $middle;
                                $endLeft = $currentPage;

                                $initRight = $currentPage +1;
                                $endRight = $initRight + $middle - 1;
                            }
                        }
                    }
                }
                
                for($i = $initLeft; $i < $endLeft ; $i++)
                {
                        if ($i > 0)
                        {
                                $paginatorHelper->addLeftPage($i);
                                $printedPages++;
                        }
                }

                if($currentPage - $printedPages > 1)
                {
                        $paginatorHelper->setLeftArrowPage($currentPage - $printedPages);
                        $printedPages++;
                }

                $paginatorHelper->setCurrentPage($currentPage);

                // Cálculo de las páginas a la izquierda de la actual 
                for($i = $initRight ; $i <= $endRight ; $i++ )
                {
                        $paginatorHelper->addRightPage($i);
                }

                if($i <= $pagesNumber)
                {
                        $paginatorHelper->setRightArrowPage($i);
                }
                
                
                
               
		
		// Cálculo de páginas que se imprimirán a la izquierda de la actual
		
//		if($visiblePages > $pagesNumber)
//		{
////			$pagesToPrint = $visiblePages - $pagesNumber;
//                        $pagesToPrint = $pagesNumber;
//		}
//		elseif($currentPage == $pagesNumber)
//		{
//			$pagesToPrint = $visiblePages - 1;
//		}
//		elseif($currentPage + floor($visiblePages / 2) > $pagesNumber)
//		{
//			//$pagesOnRightSide = ($pagesNumber - $currentPage - floor($visiblePages / 2));
//			$pagesOnRightSide = floor($visiblePages / 2) - ($pagesNumber - $currentPage );
//			
//			if($pagesOnRightSide < 0)
//			{
//				$pagesOnRightSide = 0;
//			}
//			
//			$pagesToPrint = $visiblePages - $pagesOnRightSide;
//			
//// 			$pagesToPrint = $pagesNumber - $visiblePages - $pagesOnRightSide - 1;
//		}
//		else
//		{
//			$pagesToPrint = floor($visiblePages / 2);
//		}
//		
//		if($pagesNumber > 1)
//		{
//			// Cálculo de las páginas a la izquierda de la actual
//			$printedPages = 0;
//			for($i = $currentPage - $pagesToPrint; $i < $currentPage ; $i++)
//			{
//				if ($i > 0)
//				{
//					$paginatorHelper->addLeftPage($i);
//                                        $printedPages++;
//				}
//			}
//			
//			if($currentPage - $printedPages > 1)
//			{
//				$paginatorHelper->setLeftArrowPage($currentPage - $printedPages);
//                                $printedPages++;
//			}
//						
//			$paginatorHelper->setCurrentPage($currentPage);
//			
//			// Cálculo de las páginas a la izquierda de la actual
//                        $restPages = $visiblePages - $printedPages;
//                        if ( $currentPage + $restPages > $pagesNumber)
//                        {
//                            $final = $pagesNumber;
//                        }
//                        else
//                        {
//                            $final = $currentPage + $restPages;
//                        }
//                        
//			for($i = $currentPage + 1 ; $i < $final ; $i++ )
//			{
//				$paginatorHelper->addRightPage($i);
//			}
//			
//			if($i <= $pagesNumber)
//			{
//				$paginatorHelper->setRightArrowPage($i);
//			}
//		}
		
		return $paginatorHelper;
	}
}