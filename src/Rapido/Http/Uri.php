<?php 

namespace Rapido\Http;

class Uri{
    private string $scheme = '';
    private string $host = '';
    private string $user = '';
    private string $pass = '';
    private int $port = 80;
    private string $path = '';
    private string $query = '';
    private string $fragment = '';

    public function __construct(string $url)
    {
        $parts = parse_url($url);

        $this->setScheme($parts['scheme'] ?? 'http')
            ->setHost($parts['host'] ?? '')
            ->setUser($parts['user'] ?? '')
            ->setPass($parts['pass'] ?? '')
            ->setPort((int) $parts['port'] ?? 80)
            ->setPath($parts['path'] ?? '')
            ->setQuery($parts['query'] ?? '')
            ->setFragment($parts['fragment'] ?? '');
    }

    /**
     * Get the value of fragment
     */ 
    public function getFragment(): string
    {
        return $this->fragment;
    }

    /**
     * Set the value of fragment
     *
     * @return self
     */ 
    public function setFragment(string $fragment): self
    {
        $this->fragment = $fragment;

        return $this;
    }

    /**
     * Get the value of query
     */ 
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * Set the value of query
     *
     * @return self
     */ 
    public function setQuery(string $query): self
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Get the value of path
     */ 
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Set the value of path
     *
     * @return self
     */ 
    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get the value of port
     */ 
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * Set the value of port
     *
     * @return self
     */ 
    public function setPort(int $port): self
    {
        $this->port = $port;

        return $this;
    }

    /**
     * Get the value of pass
     */ 
    public function getPass(): string
    {
        return $this->pass;
    }

    /**
     * Set the value of pass
     *
     * @return self
     */ 
    public function setPass(string $pass): self
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return self
     */ 
    public function setUser($user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of host
     */ 
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * Set the value of host
     *
     * @return self
     */ 
    public function setHost(string $host): self
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get the value of scheme
     */ 
    public function getScheme(): string
    {
        return $this->scheme;
    }

    /**
     * Set the value of scheme
     *
     * @return self
     */ 
    public function setScheme(string $scheme): self
    {
        $this->scheme = $scheme;

        return $this;
    }

}




?>