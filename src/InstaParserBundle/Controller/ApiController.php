<?php

namespace InstaParserBundle\Controller;

use InstaParserBundle\Entity\Tag;
use InstaParserBundle\Internal\Service\ServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ApiController extends Controller
{
    /**
     * @var ServiceInterface
     */
    private $downloadService;

    /**
     * @param ServiceInterface $downloadService
     */
    public function __construct(ServiceInterface $downloadService) {
        $this->downloadService = $downloadService;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function uploadAction(Request $request)
    {
        try {
            $result = 'success';
            $tagName = (new \DateTime)->getTimestamp();
            $file = $request->files->get('subscribers');

            if (!empty($file)) {
                $newDirectory = 'tmp/content';
                $file->move($newDirectory, $tagName);

                $tag = (new Tag())->setType($tagName)->setProxies($this->parseProxies($request->get('proxies')));
                $em = $this->getDoctrine()->getManager();
                $em->persist($tag);
                $em->flush();
            } else {
                $result = 'fail';
            }
        } catch (\Throwable $e) {
            $result = $e->getMessage();
        }

        return new Response($result);
    }

    /**
     * @return Response
     */
    public function downloadAction($tagId)
    {
        $pdfPath = $this->getParameter('dir.downloads').'/sample.pdf';

        return $this->file($pdfPath);
    }

    /**
     * @param $proxies
     * @return string[]
     */
    private function parseProxies($proxies): array
    {
        $result = [];
        $proxyRows = explode(PHP_EOL, $proxies);

        if (count($proxyRows)) {
            foreach ($proxyRows as $proxyRow) {
                $proxyData = explode(':', $proxyRow);

                if (count($proxyData) > 3) {
                    $result[] = [
                        'login' => $proxyData[2],
                        'password' => trim($proxyData[3]),
                        'ip' => $proxyData[0],
                        'port' => $proxyData[1],
                    ];
                }
            }
        }


        return $result;
    }
}