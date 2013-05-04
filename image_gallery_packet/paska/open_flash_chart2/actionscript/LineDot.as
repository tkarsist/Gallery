﻿class LineDot extends LineStyle
{
	public var bgColour:Number=0;
	public var name:String;
	public var mcs:Array;
	
	public function LineDot( val:String, bgColour:Number, name:String )
	{
		this.mcs=[];
		this.values = [];
		
		this.bgColour = bgColour;
		this.name = name;
		
		var vals:Array = val.split(",");
		
		this.line_width = Number( vals[0] );
		this.colour = _root.get_colour( vals[1] );
		
		if( vals.length > 2 )
			this.key = vals[2].replace('#comma#',',');
			
		if( vals.length > 3 )
			this.font_size = Number( vals[3] );
		
		if( length( vals ) > 4 )
			this.circle_size = Number( vals[4] );
			
		//this.mc2 = _root.createEmptyMovieClip(name, _root.getNextHighestDepth());
		this.mc2.clear();
		this.mc2.lineStyle( 0, 0, 0);
		this.mc2.fillCircle( 0, 0, this.circle_size+2, 15, this.bgColour );
		//this.mc2.fillCircle( 0, 0, this.circle_size-this.line_width+2, 15, this.colour );
		this.mc2.fillCircle( 0, 0, this.circle_size+1, 15, this.colour );
		this.mc2._visible = false;
			
	}
	
	/* override Style:set_values
	function set_values( v:Array, labels:Array )
	{
		for( var i:Number=0; i < v.length; i++ )
			this.add( v[i], labels[i] );
	}
	
	public function add( val:String, tool_tip:String )
	{
		super.add( val );
		
		return;
		
		if( this.circle_size > 0 )
		{
			//
			// if this is not a null value, create a tooltip for it:
			//
			if( val != 'null' )
			{
				var mc:MovieClip = _root.createEmptyMovieClip(this.name+'_dot_'+this.mcs.length, _root.getNextHighestDepth());
				var tooltip = {x_label:tool_tip, value:_root.format(val), key:this.key};
				this.make_dot( mc, this.colour, this.bgColour, tooltip );
				this.mcs.push(mc);
			}
			else
				this.mcs.push( null );
		}
	}
	*/
	// delete the left most value
	function del()
	{
		removeMovieClip(this.mcs[0]._name);
		this.mcs.shift();
		this.values.shift();
	}
	
	public function draw()
	{
		super.draw();
		
		if( this.circle_size == 0 )
			return;
		
		for( var i:Number=0; i < this.ExPoints.length; i++ )
		{
			var val:Point = this.ExPoints[i];
			this.mc.lineStyle( 0, 0, 0);
			this.mc.fillCircle( val.x, val.y, this.circle_size, 15, this.bgColour );
			//this.mc.fillCircle( val.x, val.y, this.circle_size-this.line_width, 15, this.colour );
			this.mc.fillCircle( val.x, val.y, this.circle_size-1, 15, this.colour );
		}
		
		return;
		
		
		for( var i:Number=0; i < this.ExPoints.length; i++ )
			super.move_dot( this.ExPoints[i], this.mcs[i] )
	}
}