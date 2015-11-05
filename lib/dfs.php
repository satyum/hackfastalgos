<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of DFS and other algorithms based on DFS
 *
 * Learn more
 * @link http://algs4.cs.princeton.edu/41graph/CC.java.html
 * @link https://en.wikipedia.org/wiki/Depth-first_search
 * @link http://algs4.cs.princeton.edu/41graph/DepthFirstPaths.java.html
 */

namespace HackFastAlgos;

class DFSGraphNotDagException extends \Exception{}

class DFS
{
	public function __construct(private AdjList $adjList){}

	public function run()
	{
		/*
		 * Find the connections to each node, and store its predecessor in the edge
		 * list as the vertex adjacent to the current node. Use recursion.
		 *
		 * Run the DFS to compute the connections in all components, and create every component's paths.
		 */
	}

	public function countComponents() : int
	{

	}

	public function hasPath(int $start, int $finish) : bool
	{

	}

	public function getPath(int $start, int $finish) : int
	{

	}

	public function isBipartite() : bool
	{
		// Check if every vertex connects to a vertex in a different group. (Ex. All men connect to women and visa versa.)
	}

	public function isDigraph() : bool
	{

	}

	public function isDag()
	{
		return $this->isDigraph() && !$this->hasCycles();
	}

	public function hasCycles() : bool
	{
		// Check if there are any cycles in the graph.
	}

	public function isAnEulerianCycle() : bool
	{
		// https://en.wikipedia.org/wiki/Eulerian_path
		// Every vertex must have an even number of degrees.
	}

	public static function findAllKosarajuSCC(AdjList $adjList, Node $sourceNode) : Vector<Node>
	{
		// https://en.wikipedia.org/wiki/Kosaraju%27s_algorithm
		// http://algs4.cs.princeton.edu/42digraph/KosarajuSharirSCC.java.html
		// Returns an array of leader nodes
	}

	public static function topSort(AdjList $adjList, Node $sourceNode) : Vector<Node>
	{
		$this->throwIfNotDag();

		// https://en.wikipedia.org/wiki/Topological_sorting
	}

	private function throwIfNotDag()
	{
		if (!$this->isDag()) {
			throw new DFSGraphNotDagException();
		}
	}
}