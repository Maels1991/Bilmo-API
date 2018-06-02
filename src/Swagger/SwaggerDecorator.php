<?php declare(strict_types=1);

namespace App\Swagger;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class SwaggerDecorator implements NormalizerInterface
{
  private $decorated;
  
  public function __construct(NormalizerInterface $decorated)
  {
    $this->decorated = $decorated;
  }
  
  public function normalize($object, $format = null, array $context = [])
  {
    $docs = $this->decorated->normalize($object, $format, $context);
    
    // Following routes (actions) are enabled only for IRI generation.
    // They're definitely not designed to be any useful action and thus
    // they're not meant to appear in the doc.
    unset($docs['paths']['/permissions']);
    unset($docs['paths']['/permissions/{id}']);
    
    return $docs;
  }
  
  public function supportsNormalization($data, $format = null)
  {
    return $this->decorated->supportsNormalization($data, $format);
  }
}