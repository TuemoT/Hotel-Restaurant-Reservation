<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Mime\Part;

use Symfony\Component\Mime\Exception\InvalidArgumentException;
use Symfony\Component\Mime\Header\Headers;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
class DataPart extends TextPart
{
    /** @internal */
    protected $_parent;

    private $filename;
    private $mediaType;
    private $cid;

    /**
     * @param resource|string|File $body Use a File instance to defer loading the file until rendering
     */
    public function __construct($body, string $filename = null, string $contentType = null, string $encoding = null)
    {
        unset($this->_parent);

        if ($body instanceof File && !$filename) {
            $filename = $body->getFilename();
        }

        $contentType ??= $body instanceof File ? $body->getContentType() : 'application/octet-stream';
        [$this->mediaType, $subtype] = explode('/', $contentType);

        parent::__construct($body, null, $subtype, $encoding);

        if (null !== $filename) {
            $this->filename = $filename;
            $this->setName($filename);
        }
        $this->setDisposition('attachment');
    }

    public static function fromPath(string $path, string $name = null, string $contentType = null): self
    {
<<<<<<< HEAD
<<<<<<< HEAD
        if (null === $contentType) {
            $ext = strtolower(substr($path, strrpos($path, '.') + 1));
            if (null === self::$mimeTypes) {
                self::$mimeTypes = new MimeTypes();
            }
            $contentType = self::$mimeTypes->getMimeTypes($ext)[0] ?? 'application/octet-stream';
        }

        if ((is_file($path) && !is_readable($path)) || is_dir($path)) {
            throw new InvalidArgumentException(sprintf('Path "%s" is not readable.', $path));
        }

        if (false === $handle = @fopen($path, 'r', false)) {
            throw new InvalidArgumentException(sprintf('Unable to open path "%s".', $path));
        }

        if (!is_file($path)) {
            $cache = fopen('php://temp', 'r+');
            stream_copy_to_stream($handle, $cache);
            $handle = $cache;
        }

        $p = new self($handle, $name ?: basename($path), $contentType);
        $p->handle = $handle;

        return $p;
=======
        return new self(new File($path), $name, $contentType);
>>>>>>> 66597818 ( abdou a faire un poushe)
=======
        return new self(new File($path), $name, $contentType);
>>>>>>> 78d58579d8af94d392951da7171030736b2e03fa
    }

    /**
     * @return $this
     */
    public function asInline(): static
    {
        return $this->setDisposition('inline');
    }

    /**
     * @return $this
     */
    public function setContentId(string $cid): static
    {
        if (!str_contains($cid, '@')) {
            throw new InvalidArgumentException(sprintf('Invalid cid "%s".', $cid));
        }

        $this->cid = $cid;

        return $this;
    }

    public function getContentId(): string
    {
        return $this->cid ?: $this->cid = $this->generateContentId();
    }

    public function hasContentId(): bool
    {
        return null !== $this->cid;
    }

    public function getMediaType(): string
    {
        return $this->mediaType;
    }

    public function getPreparedHeaders(): Headers
    {
        $headers = parent::getPreparedHeaders();

        if (null !== $this->cid) {
            $headers->setHeaderBody('Id', 'Content-ID', $this->cid);
        }

        if (null !== $this->filename) {
            $headers->setHeaderParameter('Content-Disposition', 'filename', $this->filename);
        }

        return $headers;
    }

    public function asDebugString(): string
    {
        $str = parent::asDebugString();
        if (null !== $this->filename) {
            $str .= ' filename: '.$this->filename;
        }

        return $str;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function getContentType(): string
    {
        return implode('/', [$this->getMediaType(), $this->getMediaSubtype()]);
    }

    private function generateContentId(): string
    {
        return bin2hex(random_bytes(16)).'@symfony';
    }

    public function __sleep(): array
    {
        // converts the body to a string
        parent::__sleep();

        $this->_parent = [];
        foreach (['body', 'charset', 'subtype', 'disposition', 'name', 'encoding'] as $name) {
            $r = new \ReflectionProperty(TextPart::class, $name);
            $this->_parent[$name] = $r->getValue($this);
        }
        $this->_headers = $this->getHeaders();

        return ['_headers', '_parent', 'filename', 'mediaType'];
    }

    public function __wakeup()
    {
        $r = new \ReflectionProperty(AbstractPart::class, 'headers');
        $r->setValue($this, $this->_headers);
        unset($this->_headers);

        if (!\is_array($this->_parent)) {
            throw new \BadMethodCallException('Cannot unserialize '.__CLASS__);
        }
        foreach (['body', 'charset', 'subtype', 'disposition', 'name', 'encoding'] as $name) {
            if (null !== $this->_parent[$name] && !\is_string($this->_parent[$name])) {
                throw new \BadMethodCallException('Cannot unserialize '.__CLASS__);
            }
            $r = new \ReflectionProperty(TextPart::class, $name);
            $r->setValue($this, $this->_parent[$name]);
        }
        unset($this->_parent);
    }
}
